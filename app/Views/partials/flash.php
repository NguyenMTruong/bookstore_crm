<?php
$success = get_flash('success');
$error   = get_flash('error');
$warning = get_flash('warning');
$info    = get_flash('info');
if (!$success && !$error && !$warning && !$info) {
    return;
}
$type = '';
$message = '';
if ($success) {
    $type = 'success';
    $message = $success;
} elseif ($error) {
    $type = 'error';
    $message = $error;
} elseif ($warning) {
    $type = 'warning';
    $message = $warning;
} else {
    $type = 'info';
    $message = $info;
}
$styles = [
    'success' => [
        'bg' => 'bg-green-600',
        'icon' => '✓'
    ],
    'error' => [
        'bg' => 'bg-red-600',
        'icon' => '✕'
    ],
    'warning' => [
        'bg' => 'bg-yellow-500',
        'icon' => '!'
    ],
    'info' => [
        'bg' => 'bg-blue-600',
        'icon' => 'ℹ'
    ]
];
$style = $styles[$type];
?>
<div
    id="flash-message"
    class="fixed top-5 right-5 z-50 flex items-center gap-3
           <?= $style['bg'] ?>
           text-white
           px-5 py-4
           rounded-xl
           shadow-2xl
           min-w-[320px]
           transition-all
           duration-500">
    <div
        class="w-8 h-8 rounded-full bg-white/20
               flex items-center justify-center
               font-bold">
        <?= $style['icon'] ?>
    </div>

    <div class="flex-1">
        <p class="font-semibold capitalize">
            <?= ucfirst($type) ?>
        </p>
        <p class="text-sm">
            <?= e($message) ?>
        </p>
    </div>

    <button
        onclick="closeFlash()"
        class="text-xl leading-none hover:text-gray-200">
        ×
    </button>
</div>

<script>
    function closeFlash() {
        const flash = document.getElementById('flash-message');
        if (!flash) return;
        flash.classList.add(
            'opacity-0',
            'translate-x-10'
        );
        setTimeout(() => flash.remove(), 500);
    }
    setTimeout(closeFlash, 10000);
</script>

