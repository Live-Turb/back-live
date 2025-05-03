<?php

/**
 * Retorna a classe de cor do Bootstrap para uma categoria de despesa
 *
 * @param string $category
 * @return string
 */
if (!function_exists('getBadgeColor')) {
    function getBadgeColor($category) {
        $colors = [
            'Marketing' => 'primary',
            'Infraestrutura' => 'success',
            'Pessoal' => 'danger',
            'Operacional' => 'warning',
            'Administrativo' => 'info',
            'Tecnologia' => 'secondary',
            'Outros' => 'dark'
        ];
        
        return $colors[$category] ?? 'secondary';
    }
}
