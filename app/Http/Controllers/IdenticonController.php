<?php

namespace App\Http\Controllers;

use App\Models\Identicon;
use Hedronium\Avity\Avity;
use Hedronium\Avity\Generators\Hash;
use Hedronium\Avity\Generators\Random;
use Hedronium\Avity\Layouts\DiagonalMirror;
use Hedronium\Avity\Layouts\HorizontalMirror;
use Hedronium\Avity\Layouts\VerticalMirror;
use Hedronium\Avity\Styles\Circle;
use Hedronium\Avity\Styles\Square;
use Hedronium\Avity\Styles\SquareCircle;
use Hedronium\Avity\Styles\Triangle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdenticonController extends Controller
{
    public function showIdenticons() {
        $identicons = Identicon::where('user_id', Auth::user()->id)->get();


        return view('identicons', [
            'idcs' => $identicons
        ]);
    }

    public function showIdenticon($id) {
        $idc = Identicon::find($id);
        return response()->file($idc->location);
    }

    public function saveIdenticon(Request $req) {
        $data = $req->validate([
            'width' => 'numeric|max:1000|min:32',
            'height' => 'numeric|max:1000|min:32',
            'style' => 'string',
            'symmetry' => 'string',
            'color' => 'string',
            'data' => 'nullable',
            'vary' => 'string',
            'spacing' => 'numeric',
            'columns' => 'numeric',
            'rows' => 'numeric',
            'padding' => 'numeric',
            'background' => 'string',
            'name' => 'required|string'
        ]);

        $width = isset($data['width']) ? $data['width']*1 : 256;
        $height = isset($data['height']) ? $data['height']*1 : 256;

        $columns = isset($data['columns']) ? $data['columns']*1 : 5;
        $rows = isset($data['rows']) ? $data['rows']*1 : 5;

        $style = isset($data['style']) ? $data['style'] : 'square';
        $symmetry = isset($data['symmetry']) ? $data['symmetry'] : 'vertical';
        $hd = isset($data['data']) ? ($data['data'] ? $data['data'] : false) : Auth::user()->email;
        $vary = isset($data['vary']) ? $data['vary'] === 'on' : true;

        $color = isset($data['color']) ? $data['color'] : '#8B5BFF';
        $background = isset($data['background']) ? $data['background'] : '#F0F0F0';

        $padding = isset($data['padding']) ? $data['padding']*1 : 32;
        $spacing = isset($data['spacing']) ? $data['spacing']*1 : 0;

        $name = $data['name'];


        $avity = Avity::init([
            'layout' => ([
                'vertical' => VerticalMirror::class,
                'horizontal' => HorizontalMirror::class,
                'diagonal' => DiagonalMirror::class
            ])[$symmetry],

            'style' => ([
                'square' => Square::class,
                'circle' => Circle::class,
                'square-circle' => SquareCircle::class,
                'triangle' => Triangle::class
            ])[$style],

            'generator' => !$hd ? Random::class : Hash::class
        ]);


        $avity->width($width);
        $avity->height($height);

        $avity->columns($columns);
        $avity->rows($rows);

        $avity->padding($padding);
        $avity->style()->spacing($spacing);

        if ($hd) {
            $avity->hash($hd);
        }

        $avity->style()->foreground(
            hexdec(substr($color, 1, 2)),
            hexdec(substr($color, 3, 2)),
            hexdec(substr($color, 5, 2))
        );

        $avity->style()->background(
            hexdec(substr($background, 1, 2)),
            hexdec(substr($background, 3, 2)),
            hexdec(substr($background, 5, 2))
        );

        if ($vary) {
            $avity->style()->variedColor();
        }


        $idc = new Identicon();
        $idc->user_id = Auth::user()->id;
        $idc->hash_data = "$hd";
        $idc->name = $name;
        $idc->save();

        $hash = sha1($idc->id);
        $path = storage_path("$hash.png");

        $avity->generate()->quality(100)->png()->toFile($path);

        $idc->location = $path;
        $idc->save();

        return response()->file($path);
    }

    public function deleteIdenticon($id) {
        $idc = Identicon::find($id);
        $idc->delete();

        return redirect()->route('list-identicons');
    }
}
