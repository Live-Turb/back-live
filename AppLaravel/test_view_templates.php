<?php
/**
 * Script para testar visualizações de templates
 * Este script simula visualizações para testar se os dados estão sendo capturados corretamente
 */

require __DIR__ . '/vendor/autoload.php';

// Carregar as variáveis de ambiente do Laravel
$dotenv = \Illuminate\Support\Env::get('.env');

// Inicializar a aplicação Laravel para acesso às models e banco de dados
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\VideoDetail;
use App\Models\ViewStatistic;
use Carbon\Carbon;

// Função para registrar mensagens de log
function logMessage($message) {
    echo $message . PHP_EOL;
    Log::info("[TESTE DE VISUALIZAÇÃO] " . $message);
}

// Limpar a tela
echo "\033[2J\033[;H";
echo "=================================================================\n";
echo "   TESTE DE VISUALIZAÇÕES DE TEMPLATES - DIAGNÓSTICO DE PROBLEMAS \n";
echo "=================================================================\n\n";

// 1. Verificar conexão com o banco de dados
try {
    DB::connection()->getPdo();
    logMessage("✅ Conexão com o banco de dados estabelecida com sucesso");
} catch (\Exception $e) {
    logMessage("❌ Erro ao conectar ao banco de dados: " . $e->getMessage());
    exit(1);
}

// 2. Verificar se há templates no sistema
$templates = VideoDetail::take(10)->get();
if ($templates->isEmpty()) {
    logMessage("❌ Nenhum template encontrado no sistema. O teste não pode continuar.");
    exit(1);
}

logMessage("✅ Encontrados " . $templates->count() . " templates no sistema");

// 3. Mostrar alguns detalhes dos templates
foreach ($templates as $index => $template) {
    logMessage("📋 Template #" . ($index + 1) . ": ID: {$template->id}, UUID: {$template->uuid}, Título: {$template->title}");
}

// 4. Escolher um template aleatório para simular visualizações
$selectedTemplate = $templates->random();
logMessage("\n🎯 Template selecionado para testes: ID: {$selectedTemplate->id}, UUID: {$selectedTemplate->uuid}");

// 5. Verificar visualizações atuais do template
$currentViews = ViewStatistic::where('template_id', $selectedTemplate->id)->count();
logMessage("📊 Visualizações atuais do template: {$currentViews}");

// 6. Simular novas visualizações
$numViewsToAdd = 5;
logMessage("\n🔄 Simulando {$numViewsToAdd} novas visualizações para o template...");

$addedViewIds = [];
$faker = \Faker\Factory::create();

for ($i = 0; $i < $numViewsToAdd; $i++) {
    $sessionId = md5($faker->uuid);
    $ipAddress = $faker->ipv4;

    // Criar uma nova visualização
    $view = new ViewStatistic();
    $view->template_id = $selectedTemplate->id;
    $view->user_id = $selectedTemplate->user_id;
    $view->viewer_session = $sessionId;
    $view->viewer_ip = $ipAddress;
    $view->device_type = $faker->randomElement(['desktop', 'mobile', 'tablet']);
    $view->browser = $faker->randomElement(['Chrome', 'Firefox', 'Safari', 'Edge']);
    $view->os = $faker->randomElement(['Windows', 'macOS', 'iOS', 'Android', 'Linux']);
    $view->country = $faker->countryCode;
    $view->city = $faker->city;
    $view->save();

    $addedViewIds[] = $view->id;

    logMessage("✅ Visualização #{$i} adicionada: ID: {$view->id}, IP: {$ipAddress}, Sessão: {$sessionId}");

    // Pausa de 1 segundo entre visualizações
    sleep(1);
}

// 7. Verificar visualizações após adicionar
$newViews = ViewStatistic::where('template_id', $selectedTemplate->id)->count();
logMessage("\n📊 Visualizações do template após simulação: {$newViews} (+" . ($newViews - $currentViews) . ")");

// 8. Verificar visualizações adicionadas
$addedViews = ViewStatistic::whereIn('id', $addedViewIds)->get();
logMessage("\n🔍 Verificando visualizações adicionadas:");

foreach ($addedViews as $view) {
    logMessage("📋 Visualização ID: {$view->id}, Template ID: {$view->template_id}, Criado em: {$view->created_at}");
}

// Verificando a consulta do KpiController para templates ativos
echo "\n\n📊 Templates ativos encontrados pela consulta do KpiController: ";
try {
    $fiveMinutesAgo = date('Y-m-d H:i:s', strtotime('-5 minutes'));

    $activeTemplates = DB::table('view_statistics')
        ->join('video_details', 'view_statistics.template_id', '=', 'video_details.id')
        ->select(
            'video_details.id',
            'video_details.uuid',
            'video_details.details_video_title as title',
            DB::raw('COUNT(DISTINCT view_statistics.viewer_session) as active_viewers'),
            DB::raw('COUNT(view_statistics.id) as total_views'),
            DB::raw('MAX(view_statistics.created_at) as last_view_at')
        )
        ->where('view_statistics.created_at', '>=', $fiveMinutesAgo)
        ->whereNotNull('view_statistics.template_id')
        ->groupBy('video_details.id', 'video_details.uuid', 'video_details.details_video_title')
        ->orderBy('active_viewers', 'desc')
        ->get();

    echo count($activeTemplates) . "\n";

    foreach ($activeTemplates as $template) {
        echo "📋 Template: ID: {$template->id}, UUID: {$template->uuid}, Visualizadores ativos: {$template->active_viewers}, Última visualização: {$template->last_view_at}\n";
    }

    if (in_array($selectedTemplate->id, $activeTemplates->pluck('id')->toArray())) {
        echo "\n✅ SUCESSO: O template usado no teste aparece nos resultados da consulta do KpiController!\n";
    } else {
        echo "\n❌ ERRO: O template usado no teste NÃO aparece nos resultados da consulta do KpiController.\n";
    }
} catch (\Exception $e) {
    echo "ERRO ao consultar templates ativos: " . $e->getMessage() . "\n";
}

logMessage("\n=================================================================");
logMessage("Teste concluído! Agora verifique o painel de admin para confirmar se os templates estão aparecendo.");
logMessage("=================================================================\n");
