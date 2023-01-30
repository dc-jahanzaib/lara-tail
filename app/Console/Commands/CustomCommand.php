<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CustomCommand extends Command
{
    protected $modelName;
    protected $attrName   = null;
    protected $type       = null;
    protected $constraint = null;
    protected $migrations = [];
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:z-model {modelName}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Your model name is {modelName}';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // $modelName = ucwords($this->argument('modelName'));

        $this->modelName = ucwords($this->ask('What is your model name?'));

        $this->addMigrationLine();

        // $this->info('Model :'. $m_name);
        // $this->table(
        //     ['No', 'Name', 'Type', 'Constraints', 'Output'],
        //     [
        //         [
        //             "no" => "0",
        //             "name" => "test",
        //             "type" => "string",
        //             "const" => "string",
        //             "output" => '$table->string("name")',
        //         ],
        //         [
        //             "no" => "0",
        //             "name" => "test",
        //             "type" => "string",
        //             "const" => "string",
        //             "output" => '$table->string("name")',
        //         ],
        //     ]
        // );

        // $attr = $this->ask('Type name?');
        // $this->info('attr: ' . $attr);
        // $this->newLine();

        // $attr = $this->ask('Please tell attr');
        // $this->showSummary($attr);


        // $this->info('The command was successful!');
        // $this->error('Something went wrong!');
        // $this->line('Display this on the screen');

        // $this->clear();

        // $name = $this->choice(
        //     'What is your name?',
        //     ['Taylor', 'Dayle'],
        // );
        // $name = $this->ask('What is your model name?');

        // shell_exec('composer du');

        return Command::SUCCESS;
    }

    public function addMigrationLine()
    {
        $this->printSummary();

        $this->attrName   = $this->ask('Attribute name?');

        $this->printSummary();

        $this->table(
            ['No', 'Name'],
            [
                [
                    'no' => 1,
                    'name' => 'string, 255',
                ],
                [
                    'no' => 2,
                    'name' => 'int',
                ],
                [
                    'no' => 3,
                    'name' => 'text',
                ],
                [
                    'no' => 4,
                    'name' => 'mediumText',
                ],

            ]
        );

        $this->type   = $this->ask('Data type?');

        $this->printSummary();

        $this->constraint = $this->ask('Constraint?');
        
        $this->printSummary();

        $row = [
            "no"        => count($this->migrations) + 1,
            "name"      => $this->attrName,
            "type"      => $this->type,
            "const"     => $this->constraint,
            "output"    => '$table->string("' . $this->attrName . '")',
        ];

        array_push($this->migrations, $row);
        
        if ($this->confirm('Do you wish to continue?', true)) {
            $this->addMigrationLine($this->modelName);
        }
    }

    public function printSummary()
    {
        $this->clear();

        $this->info('Model :' . $this->modelName);
        $this->table(
            ['No', 'Name', 'Type', 'Constraints', 'Output'],
            // $this->migrations,
            [
                [
                    "no"            => "0",
                    "name"          => $this->attrName ?? '-',
                    "type"          => $this->type ?? '-',
                    "constraints"   => $this->constraint ?? '-',
                    "output"        => 'table',
                ]
            ]
        );
    }

    public function showMigrations()
    {
        $this->clear();

        $this->info('Model :' . $this->modelName);
        $this->table(
            ['No', 'Name', 'Type', 'Constraints', 'Output'],
            $this->migrations,
        );
    }

    public function clear()
    {
        system('clear');
        // if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        //     system('cls');
        // } else {
        //     system('clear');
        // }
    }

    public function makeModel($name)
    {
        $modelPath = base_path("app/Models/$name" . ".php");

        if (File::exists($modelPath)) {
            $this->info($name . " model already exists.");
            return 0;
        }


        // $contents = File::get(base_path('/stubs/module.model.stub'));
        // File::put( $modulePath.$model.$moduleName.'.php', $contents);
        // $message = (true)
        //     ? 'Model created successfully.'
        //     : 'Module model creation fail';
        // $this->info($message);

        // $model = "/app/Models/";        
        // dd(File::exists($modelPath.'.php'));
        // dd($modelPath);

        // if(!File::exists($modelPath.$model.$name.'.php')){
        //     File::makeDirectory($modulePath.$model, 0775, true, true);
        //     // $fileContents = $this->fileContents($moduleName, base_path('/stubs/model.stub'), 'read');
        //     // $contents = file_get_contents(base_path('/stubs/model.stub'));

        //     $contents = File::get(base_path('/stubs/module.model.stub'));

        //     File::put( $modulePath.$model.$moduleName.'.php', $contents);

        //     // $written = fileContents(
        //     //     $moduleName,
        //     //     $model,
        //     //     'write',
        //     //     $fileContents
        //     // );

        //     $message = (true)
        //         ? 'Model created successfully.'
        //         : 'Module model creation fail';
        //     $this->info($message);
        // }
    }
}
