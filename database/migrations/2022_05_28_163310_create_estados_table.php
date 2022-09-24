<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateEstadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $estados = [
            'UF', 'AC', 'AL', 'AM', 'AP', 'BA', 'CE',
            'DF', 'ES', 'GO', 'MA', 'MG', 'MS', 'MT',
            'PA', 'PB', 'PE', 'PI', 'PR', 'RJ', 'RN',
            'RO', 'RR', 'RS', 'SC', 'SE', 'SP', 'TO'
        ];

        Schema::create('estados', function (Blueprint $table) {
            $table->id();
            $table->string('uf');
            $table->timestamps();
        });
        foreach ($estados as $estado) {
            DB::table('estados')->insert(
                array(
                    'uf' => $estado
                )
            );
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('estados');
    }
}
