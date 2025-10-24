<?php

namespace App\Console\Commands;

use App\Models\Artist;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use League\Csv\Reader;
use League\Csv\Statement;

class ImportArtistCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    // protected $signature = 'import:csv {path : Data Reference (ALBUM SALES).csv}';
    protected $signature = 'import:csv {filename : The name of the CSV file in public/csv_files}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import data from a CSV file into the database';
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

        $this->info("Importing from: {$path}");

        // Read CSV
        $csv = Reader::createFromPath($path, 'r');
        $csv->setHeaderOffset(0); // first row = headers
        $records = (new Statement())->process($csv);

        $imported = 0;
        $skipped = 0;

        DB::beginTransaction();

        try {
            foreach ($records as $record) {
                $name = trim($record['Artist']); // assuming the column header is 'name'

                // Skip if name already exists in database
                if (Artist::where('name', $name)->exists()) {
                    $skipped++;
                    continue;
                }

                // Skip if name is duplicated within the CSV file
                static $seen = [];
                if (in_array(strtolower($name), $seen)) {
                    $skipped++;
                    continue;
                }
                $seen[] = strtolower($name);

                // Insert into DB
                Artist::create([
                    'name' => $name,
                ]);

                $imported++;
            }

            DB::commit();

            $this->info("Import completed!");
            $this->info("Imported: {$imported}");
            $this->info("Skipped (duplicates): {$skipped}");
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error('Import failed: ' . $e->getMessage());
        }
    }
}
