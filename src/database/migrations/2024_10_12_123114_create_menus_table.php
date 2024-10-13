<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();

            // Combine required columns and extra fields from config
            $columns = array_merge(
                config('sidemenu.menu_columns', []),
                config('sidemenu.extra_field', [])
            );

            // Loop through columns and define their types
            foreach ($columns as $column => $type) {
                $this->addColumnToTable($table, $column, $type);
            }

            $table->timestamps();
        });
    }

    /**
     * Add a column to the table based on its type.
     *
     * @param Blueprint $table
     * @param string $column
     * @param string $type
     * @return void
     */
    protected function addColumnToTable(Blueprint $table, string $column, string $type): void
    {
        switch ($type) {
            case 'bigInteger':
                $table->bigInteger($column)->nullable();
                break;
            case 'binary':
                $table->binary($column)->nullable();
                break;
            case 'boolean':
                $table->boolean($column)->nullable();
                break;
            case 'char':
                $table->char($column, 255)->nullable();
                break;
            case 'date':
                $table->date($column)->nullable();
                break;
            case 'datetime':
            case 'dateTime':
                $table->dateTime($column)->nullable();
                break;
            case 'datetimetz':
            case 'dateTimeTz':
                $table->dateTimeTz($column)->nullable();
                break;
            case 'decimal':
                $table->decimal($column, 8, 2)->nullable();
                break;
            case 'double':
                $table->double($column, 8, 2)->nullable();
                break;
            case 'enum':
                $table->enum($column, [])->nullable();
                break;
            case 'float':
                $table->float($column, 8, 2)->nullable();
                break;
            case 'foreignId':
                $table->foreignId($column)->nullable()->constrained();
                break;
            case 'geometry':
                $table->geometry($column)->nullable();
                break;
            case 'geometryCollection':
                $table->geometryCollection($column)->nullable();
                break;
            case 'increments':
                $table->increments($column);
                break;
            case 'integer':
                $table->integer($column)->nullable();
                break;
            case 'ipAddress':
                $table->ipAddress($column)->nullable();
                break;
            case 'json':
            case 'jsonb':
                $table->json($column)->nullable();
                break;
            case 'lineString':
                $table->lineString($column)->nullable();
                break;
            case 'longText':
                $table->longText($column)->nullable();
                break;
            case 'macAddress':
                $table->macAddress($column)->nullable();
                break;
            case 'mediumInteger':
                $table->mediumInteger($column)->nullable();
                break;
            case 'mediumText':
                $table->mediumText($column)->nullable();
                break;
            case 'morphs':
                $table->morphs($column);
                break;
            case 'multiLineString':
                $table->multiLineString($column)->nullable();
                break;
            case 'multiPoint':
                $table->multiPoint($column)->nullable();
                break;
            case 'multiPolygon':
                $table->multiPolygon($column)->nullable();
                break;
            case 'nullableMorphs':
                $table->nullableMorphs($column);
                break;
            case 'nullableTimestamps':
                $table->nullableTimestamps();
                break;
            case 'point':
                $table->point($column)->nullable();
                break;
            case 'polygon':
                $table->polygon($column)->nullable();
                break;
            case 'rememberToken':
                $table->rememberToken();
                break;
            case 'set':
                $table->set($column, [])->nullable();
                break;
            case 'smallInteger':
                $table->smallInteger($column)->nullable();
                break;
            case 'softDeletes':
                $table->softDeletes();
                break;
            case 'softDeletesTz':
                $table->softDeletesTz();
                break;
            case 'string':
                $table->string($column, 255)->nullable();
                break;
            case 'text':
                $table->text($column)->nullable();
                break;
            case 'time':
                $table->time($column)->nullable();
                break;
            case 'timeTz':
                $table->timeTz($column)->nullable();
                break;
            case 'timestamp':
                $table->timestamp($column)->nullable();
                break;
            case 'timestampTz':
                $table->timestampTz($column)->nullable();
                break;
            case 'tinyInteger':
                $table->tinyInteger($column)->nullable();
                break;
            case 'unsignedBigInteger':
                $table->unsignedBigInteger($column)->nullable();
                break;
            case 'unsignedInteger':
                $table->unsignedInteger($column)->nullable();
                break;
            case 'unsignedMediumInteger':
                $table->unsignedMediumInteger($column)->nullable();
                break;
            case 'unsignedSmallInteger':
                $table->unsignedSmallInteger($column)->nullable();
                break;
            case 'unsignedTinyInteger':
                $table->unsignedTinyInteger($column)->nullable();
                break;
            case 'uuid':
                $table->uuid($column)->nullable();
                break;
            case 'year':
                $table->year($column)->nullable();
                break;
            case 'timestamps':
                $table->timestamps();
                break;
            case 'timestampsTz':
                $table->timestampsTz();
                break;
            default:
                throw new Exception("Unsupported column type: {$type}");
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
