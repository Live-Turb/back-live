<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTestCountriesToViewStatistics extends Migration
{
    /**
     * Run the migration.
     *
     * @return void
     */
    public function up()
    {
        // Verificar se a tabela existe e se temos os registros necessários
        if (Schema::hasTable('view_statistics') &&
            Schema::hasTable('users') &&
            Schema::hasTable('video_details')) {

            $userRecord = DB::table('users')->first();
            $templateRecord = DB::table('video_details')->first();

            // Só prosseguir se tivermos um usuário e um modelo de template
            if ($userRecord && $templateRecord) {
                $userId = $userRecord->id;
                $templateId = $templateRecord->id;

                // Os principais países que queremos adicionar para teste
                $countries = [
                    'BR', 'US', 'PT', 'ES', 'MX', 'CO', 'AR', 'CL', 'PE', 'UY'
                ];

                $now = now();

                // Para cada país, inserimos 5-10 registros
                foreach ($countries as $index => $country) {
                    $records = rand(5, 10);

                    for ($i = 0; $i < $records; $i++) {
                        DB::table('view_statistics')->insert([
                            'template_id' => $templateId,
                            'user_id' => $userId,
                            'viewer_ip' => '127.0.0.' . rand(1, 255),
                            'viewer_session' => 'test-session-' . uniqid(),
                            'country' => $country,
                            'city' => 'Test City',
                            'device_type' => ['desktop', 'mobile', 'tablet'][rand(0, 2)],
                            'browser' => ['Chrome', 'Firefox', 'Safari', 'Edge'][rand(0, 3)],
                            'os' => ['Windows', 'macOS', 'Linux', 'iOS', 'Android'][rand(0, 4)],
                            'is_unique' => rand(0, 1),
                            'created_at' => $now->subMinutes(rand(1, 60 * 24 * 7)), // Últimos 7 dias
                            'updated_at' => $now
                        ]);
                    }
                }
            }
        }
    }

    /**
     * Reverse the migration.
     *
     * @return void
     */
    public function down()
    {
        // Não removemos os dados de teste, pois isso pode afetar dados reais
        // Se necessário, isso poderia ser implementado com uma marcação específica
    }
}
