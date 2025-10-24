<?php

namespace App\Console\Commands;

use App\Models\Album;
use App\Models\Artist;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use League\Csv\Statement;

class ImportAlbumsCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:albums {filename : The name of the CSV file in public/csv_files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import albums from a CSV file into the database, extracting year and linking to artists.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $filename = $this->argument('filename');
        $path = public_path("csv_files/{$filename}");

        if (!file_exists($path)) {
            $this->error("File not found: {$path}");
            return;
        }

        $this->info("Importing albums from: {$path}");

        // Read CSV
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0);
        $records = (new Statement())->process($csv);

        $imported = 0;
        $skipped = 0;

        DB::beginTransaction();

        try {
            foreach ($records as $record) {
                $artistName = trim($record['Artist']);
                $albumName = trim($record['Album']);

                // Skip if album already exists for the artist
                $artist = Artist::where('name', $artistName)->first();
                if (!$artist) {
                    $this->warn("Artist not found: {$artistName}. Skipping...");
                    $skipped++;
                    continue;
                }

                // Extract year from SQL date (YYYY-MM-DD)
                $year = null;
                if (!empty($record['Date Released'])) {
                    $dateValue = trim($record['Date Released']);

                    // Get first two digits (YY)
                    $yy = substr($dateValue, 0, 2);

                    if (is_numeric($yy)) {
                        $year = (int) $yy;

                        // If year < 50 → assume 2000s; else assume 1900s
                        $year = ($year < 50) ? (2000 + $year) : (1900 + $year);
                    } else {
                        $this->warn("Invalid date format for album '{$albumName}': {$dateValue}");
                        $skipped++;
                        continue;
                    }
                }

                // Prevent duplicate albums for the same artist
                if (Album::where('name', $albumName)->where('artist_id', $artist->id)->exists()) {
                    $skipped++;
                    continue;
                }

                // Create the album
                Album::create([
                    'year' => $year,
                    'name' => $albumName,
                    'sales' => $record['2022 Sales'] ?? 0,
                    'details' => $record['details'] ?? null,
                    'album_cover' => $record['album_cover'] ?? null,
                    'artist_id' => $artist->id,
                ]);

                $imported++;
            }

            DB::commit();

            $this->info("Import completed!");
            $this->info("Imported: {$imported}");
            $this->info("Skipped: {$skipped}");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Import failed: " . $e->getMessage());
        }
    }
}
