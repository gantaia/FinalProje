<?php

namespace App\Controllers;

use App\Models\AnasayfaModel;
use App\Models\MongoModel;

class Anasayfa extends BaseController
{
    protected $helpers = ['form', 'text'];


    public function index()
    {
        $data = [];

        $model = model('AnasayfaModel');

        $kayitlar = $model->kayitlar();

        $mongoModel = new MongoModel();
        $yorumlar = $mongoModel->getYorumlar(); // Veriyi MongoDB'den çek

        // Veriyi view'e aktar
        $yorum['yorumlar'] = $yorumlar;


        if (count($kayitlar) > 0) {
            $data['kayitlar'] = $kayitlar;
        }


        $session = session();

        if ($session->has('durum') && $session->get('durum')) {

            $data['isim'] = $session->get('isim');
            $data['durum'] = $session->get('durum');


            return view('tema/header', $data)
                . view('sayfalar/anasayfa', $yorum)
                . view('tema/footer');
        } else {

            return view('tema/header', $data)
                . view('sayfalar/anasayfa', $yorum)
                . view('tema/footer');
        }
    }


    public function logout()
    {
        $session = session();
        $session->destroy();

        return redirect()->to(base_url('login'));
    }

    public function incele($url)
    {
        $data = [];
        $model = model('AnasayfaModel');

        $veri = $model->kayit_detay($url);
        $data['veri'] = $veri[0];

        $session = session();
        if ($session->has('durum') && $session->get('durum')) {

            $data['isim'] = $session->get('isim');
            $data['durum'] = $session->get('durum');
        }


        return view('tema/header', $data)
            . view('sayfalar/incele')
            . view('tema/footer');
    }

    public function login()
    {
        $session = session();
        if ($session->has('durum') && $session->get('durum')) {
            return redirect()->to(base_url('panel'));
        } else {
            if (!$this->request->is('post')) {
                return view('tema/header') . view('sayfalar/login') . view('tema/footer');
            }

            $rules = [
                'kulad' => 'required',
                'sifre' => 'required'
            ];

            if (!$this->validate($rules)) {
                return view('tema/header') . view('sayfalar/login') . view('tema/footer');
            }

            $veri = $this->validator->getValidated();
            $model = model('AnasayfaModel');
            $sor = $model->where(['kulad' => $veri['kulad']])->first(); // Veritabanındaki kullanıcıyı bul

            if ($sor) {
                // Veritabanındaki şifre ile gelen şifreyi doğrula
                if (password_verify($veri['sifre'], $sor['sifre'])) {
                    // Şifre doğru ise giriş yap
                    $kul_bilgi = [
                        'isim' => 'Cenk',
                        'durum' => true
                    ];

                    $session->set($kul_bilgi);
                    return redirect()->to(base_url('panel'));
                } else {
                    // Şifre yanlış
                    return view('tema/header', ['uyari' => 'Yanlış Şifre']) . view('sayfalar/login') . view('tema/footer');
                }
            } else {
                // Kullanıcı adı bulunamadı
                return view('tema/header', ['uyari' => 'Kullanıcı Adı Bulunamadı']) . view('sayfalar/login') . view('tema/footer');
            }
        }
    }
}
