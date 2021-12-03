<?php

namespace App\Http\Controllers;

use App\Models\Arvore;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PlacaController extends Controller
{

    public function show(string $codigo_unico)
    {

        $arvore = Arvore::select('*')->where('codigo_unico', $codigo_unico)->get()->first();
        $img = Image::make(public_path('placa_template.png'))->resize(1920, 1080);

        // qrcode
        $img->insert(base64_encode(QrCode::format('png')->size(308.406)->color(59, 76, 66)->backgroundColor(144, 172, 142)->generate(route('arvores.show', ['arvore' => $arvore->codigo_unico]))), 'top-right', 205, 100);

        // nome (s) popular(es)
        $arvore_texto = $arvore->especie->nome_popular;

        $palavras = explode(',', $arvore_texto);
        $incremento = 0;
        foreach ($palavras as $palavra) {
            if (next($palavras)) {
                $palavra .= ', ';
            }
            $img->text($incremento, 100, 100);
            if (strlen($palavra) > 20) {
                $palavra_grande = explode('-', $palavra);
                foreach ($palavra_grande as $palavra_pequena) {
                    if (next($palavra_grande)) {
                        $palavra_pequena .= '-';
                    }
                    $img->text(trim($palavra_pequena), 510, (335 + $incremento), function ($font) {
                        $font->file(public_path('fonts/Now-Bold.otf'));
                        $font->size(80);
                        $font->color('#3b4342');
                        $font->valign('top');
                    });
                    $incremento += 80;
                }
            } else {
                $img->text(trim($palavra), 510, (335 + $incremento), function ($font) {
                    $font->file(public_path('fonts/Now-Bold.otf'));
                    $font->size(78);
                    $font->color('#3b4342');
                    $font->valign('top');
                });
                $incremento += 80;
            }
        }
        // nome científico
        $nome_cientifico = $arvore->especie->nome_cientifico;
        $img->text($nome_cientifico, 510, 710, function ($font) {
            $font->file(public_path('fonts/OpenSans-BoldItalic.ttf'));
            $font->size(70);
            $font->color('#3b4342');
            $font->valign('top');
        });

        return $img->response('jpg');
    }
}
