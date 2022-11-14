<?php

use App\Controllers\WaliKelas;
use App\Models\GuruModel;
use App\Models\SiswaModel;
use App\Models\UserModel;
use App\Models\WaliKelasModel;

function profile()
{
    $model = new UserModel();
    $user = $model->find(session('user')->user_id);
    return $user->user_profile;
}
function guru()
{
    $model = new GuruModel();
    return $model->find(session('guru')->guru_id);
}
function admin()
{
    $model = new UserModel();
    $user = $model->find(session('user')->user_id);
    return $user;
}
function user()
{
    $model = new UserModel();
    $user = $model->find(session('user')->user_id);
    return $user;
}
function siswa()
{
    $model = new SiswaModel();
    return $model->find(session('siswa')->siswa_id);
}
function cekWali()
{
    $guru_id = session('guru')->guru_id;
    $model = new WaliKelasModel();
    $model->where('guru_id', $guru_id);
    $result = $model->find();
    if (!empty($result))
        return true;
    return false;
}
