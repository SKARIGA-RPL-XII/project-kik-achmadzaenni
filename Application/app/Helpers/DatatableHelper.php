<?php
if (!function_exists('btn_action')) {
    function btn_action($id, $type)
    {
        $btn_view  = '<button class="btn-view inline-flex items-center px-2 py-2 ring-1 ring-inset ring-brand-subtle text-fg-brand-strong hover:bg-blue-400 hover:text-white transition-all duration-300 text-sm font-medium rounded bg-brand-softer" data-id="'.$id.'" data-type="'.$type.'"><i class="fa-solid fa-eye"></i></button>';
        $btn_edit  = '<button class="btn-edit inline-flex items-center px-2 py-2 ring-1 ring-inset ring-warning-subtle text-fg-warning hover:bg-yellow-400 hover:text-white transition-all duration-300 text-sm font-medium rounded bg-warning-soft" data-id="'.$id.'" data-type="'.$type.'"><i class="fa-solid fa-pen"></i></button>';
        $btn_hapus = '<button class="btn-delete inline-flex items-center px-2 py-2 ring-1 ring-inset ring-danger-subtle text-fg-danger-strong hover:bg-red-400 hover:text-white transition-all duration-300 text-sm font-medium rounded bg-danger-soft" data-modal-target="global-confirm-modal" data-modal-toggle="global-confirm-modal" data-method="POST" data-title="Hapus data" data-message="Apakah ingin menghapus data?" data-id="'.$id.'" data-type="'.$type.'"><i class="fa-solid fa-trash-can"></i></button>';

        return $btn_view . ' ' . $btn_edit . ' ' . $btn_hapus;
    }
}
