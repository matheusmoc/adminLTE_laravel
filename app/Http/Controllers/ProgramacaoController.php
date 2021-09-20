<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProgramacaoController extends Controller
{
   public function programacao(){
       return view('painel.programacao.programacao');
   }
}
