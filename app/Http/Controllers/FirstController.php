<?php

namespace App\Http\Controllers;
use App\Models\yonetıcı;
use App\Models\ogrenci;
use App\Models\ogrenciikik;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Pdf;
use App\Models\tez;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMail;
use App\Mail\mailbir;



class FirstController extends Controller
{
    function getIndex(){

        //$yonetici= yonetıcı::find(1);

        return view('gırıs');
    }
    public function logın() {

        return view('gırıs');
    }
    public function denemeiki(Request $request) {

        $sifre= $request->password;
       // $hash=password_hash($sifre,PASSWORD_DEFAULT);
        $numara= $request->email;
        $users = DB::table('onayliogrenci')->where('numara', $numara)->value('sifre');
        $data= DB::table('onayliogrenci')->where('numara', $numara)->get();
        //$data = DB::select('select * from yonetıcıs')->where('numara', $numara);
        if (Hash::check($sifre, $users)) {
            if  ($users!=null){
                return view('Öğrenci',array('numara'=>$data));

                }
        }

  else {
    return redirect('anaekran')->with('status','Hatalı Giriş' );
  }


    }
    public function profil ($id){
        $data= DB::table('onayliogrenci')->where('numara', $id)->get();
        return view('ogrenciprofil',array('numara'=>$data));
    }

    public function logıniki($id) {
        $data= DB::table('onayliogrenci')->where('numara', $id)->get();

        return view('Öğrenci',array('numara'=>$data));
    }
    public function yoneticilogin () {


        return view('yoneticigiris');
    }
    public function denemeüc(Request $request) {

        $sifre= $request->password;
        $numara= $request->email;
        $users = DB::table('yonetıcıs')->where('numara', $numara)->value('sifre');
        $data= DB::table('yonetıcıs')->where('numara', $numara)->get();
        //$data = DB::select('select * from yonetıcıs')->where('numara', $numara);
        if (Hash::check($sifre, $users)){
   return view('SistemYöneticisi',array('numara'=>$data));

   }
  else {
    return redirect('anaekran')->with('status','Hatalı Giriş' );
  }
 }
 public function profilyonetici ($id){
    $data= DB::table('yonetıcıs')->where('numara', $id)->get();
    return view('yoneticiprofil',array('numara'=>$data));
}
public function yoneticianaekran($id) {
    $data= DB::table('yonetıcıs')->where('numara', $id)->get();

    return view('SistemYöneticisi',array('numara'=>$data));
}
public function danısmanekle ($id) {


    $data= DB::table('yonetıcıs')->where('numara', $id)->get();
    return view('sistemdanısmanekle',array('numara'=>$data));
}
public function ogrenciekle ($id) {


    $data= DB::table('yonetıcıs')->where('numara', $id)->get();
    $dataiki= DB::select('select * from ogrenci');
    //$data= DB::table('ogrenci')->where('numara', $id)->get();

    return view('sistemogrenciekle',array('numara'=>$data,'ogrencinumara'=>$dataiki));

}
public function ogrenciekleiki ($id,$idiki) {


    $dataseksen= DB::table('ogrenci')->where('numara', $id)->value('ad');
    $dataiki= DB::table('ogrenci')->where('numara', $id)->value('soyad');
    $dataüc= DB::table('ogrenci')->where('numara', $id)->value('numara');
    $datadört= DB::table('ogrenci')->where('numara', $id)->value('email');
    $dataon= DB::table('ogrenci')->where('numara', $id)->value('sifre');
    $databes= DB::table('ogrenci')->where('numara', $id)->value('fakülte');
    $dataaltı= DB::table('ogrenci')->where('numara', $id)->value('bölüm');
    $datayedi= DB::table('ogrenci')->where('numara', $id)->value('sınıf');
    $datasekiz= DB::table('ogrenci')->where('numara', $id)->value('telefon');

    $danısman='bos';
    DB::table('onayliogrenci')->insert(
        array(
               'ad'     =>$dataseksen,
               'soyad'   =>$dataiki,
               'sifre'     =>$dataon,
               'numara'   =>$dataüc,
               'email'     =>$datadört,
               'fakülte'   =>$databes,
               'bölüm'     =>$dataaltı,
               'sınıf'   =>$datayedi,
               'telefon'     =>$datasekiz,
               'danısman'  =>$danısman
        )
   );

   DB::delete('delete from ogrenci where numara = ? ',[$id]);
   $data = [
    'name' => $dataseksen,
    'email' => $datadört,
    'sifre' => 'Sifreniz Oluşturduğunuz Şifredir',
    'message' => 'Sisteme Eklendiniz Şifreniz'
  ];
  Mail::to($data['email']) -> send(new ContactMail($data));


   $dataeksi= DB::table('yonetıcıs')->where('numara', $idiki)->get();
   $dataikis= DB::select('select * from ogrenci');
   return view('sistemogrenciekle',array('numara'=>$dataeksi,'ogrencinumara'=>$dataikis));


    }
    public function danısmann(Request $request,$id) {

        $ad= $request->ad;
        $soyad= $request->soyad;
        $numara= $request->numara;
        $email= $request->email;
        $ünvan= $request->ünvan;
        $sifre = rand(0,150);
        $sifreiki=password_hash($sifre,PASSWORD_DEFAULT);
        DB::table('danısman')->insert(
            array(
                   'ad'     =>$ad,
                   'soyad'   =>$soyad,
                   'sifre'     =>$sifreiki,
                   'numara'   =>$numara,
                   'email'     =>$email,
                   'ünvan'   =>$ünvan

            ));

            $data = [
                'name' => $ad,
                'email' => $email,
                'sifre' => $sifre,
                'message' => 'Sisteme Eklendiniz Şifreniz'
              ];
              Mail::to($data['email']) -> send(new ContactMail($data));


            $dataeksi= DB::table('yonetıcıs')->where('numara', $id)->get();

            return view('sistemdanısmanekle',array('numara'=>$dataeksi));
 }
 public function onkayitgiris () {


    return view('ogrencionkayıt');
}
public function ekle(Request $request) {

    $ad= $request->ad;
    $soyad= $request->soyad;
    $numara= $request->numara;
    $email= $request->email;
    $sifre = $request->sifre;
   $sifreiki=password_hash($sifre,PASSWORD_DEFAULT);
    $fakülte= $request->fakülte;
    $bölüm= $request->bölüm;
    $sınıf= $request->sınıf;
    $telefon= $request->telefon;

    DB::table('ogrenci')->insert(
        array(
               'ad'     =>$ad,
               'soyad'   =>$soyad,
               'sifre'     =>$sifreiki,
               'numara'   =>$numara,
               'email'     =>$email,
               'fakülte'     =>$fakülte,
               'bölüm'   =>$bölüm,
               'sınıf'     =>$sınıf,
               'telefon'   =>$telefon,



        ));
 return redirect('anaekran')->with('status','On Kayıt Tamamlandı' );

}
public function danısmangiris(Request $request) {

    $sifre= $request->password;
    $numara= $request->email;
    $users = DB::table('danısman')->where('numara', $numara)->value('sifre');
    $data= DB::table('danısman')->where('numara', $numara)->get();
    if (Hash::check($sifre, $users)) {

            return view('danışman',array('numara'=>$data));


    }
else {
return redirect('anaekran')->with('status','Hatalı Giriş' );
}
}
public function danısmangırıs () {


    return view('danısmangiris');
}
public function guncelleyonetıcı ($id) {

    $data= DB::table('yonetıcıs')->where('numara', $id)->get();
    return view('yonetıcıguncelle',array('numara'=>$data));

}
public function sistemgüncelle(Request $request,$id) {

    $ad= $request->ad;
    $soyad= $request->soyad;
    $email= $request->email;
    $ünvan= $request->ünvan;
    $sifre = $request->sifre;
    $sifreiki=password_hash($sifre,PASSWORD_DEFAULT);
    DB::update('update yonetıcıs set ad = ?,soyad=?,email=?,ünvan=?,sifre=? where numara = ?',[$ad,$soyad,$email,$ünvan,$sifreiki,$id]);
        $dataeksi= DB::table('yonetıcıs')->where('numara', $id)->get();

        return view('yoneticiprofil',array('numara'=>$dataeksi));
}
public function guncelleogrenci ($id) {

    $data= DB::table('onayliogrenci')->where('numara', $id)->get();
    return view('ogrenciguncelle',array('numara'=>$data));

}
public function ogrencigüncelle(Request $request,$id) {

    $ad= $request->ad;
    $soyad= $request->soyad;
    $email= $request->email;
    $sifre = $request->sifre;
    $sifreiki=password_hash($sifre,PASSWORD_DEFAULT);
    $fakülte= $request->fakülte;
    $bölüm= $request->bölüm;
    $sınıf= $request->sınıf;
    $telefon = $request->telefon;

    DB::update('update onayliogrenci set ad = ?,soyad=?,email=?,sifre=?,fakülte = ?,bölüm=?,sınıf=?,telefon=?,danısman=? where numara = ?',[$ad,$soyad,$email,$sifreiki,$fakülte,$bölüm,$sınıf,$telefon,$id]);
        $dataeksi= DB::table('onayliogrenci')->where('numara', $id)->get();

        return view('ogrenciprofil',array('numara'=>$dataeksi));
}
public function profildanısman ($id){
    $data= DB::table('danısman')->where('numara', $id)->get();
    return view('danısmanprofil',array('numara'=>$data));
}
public function danısmangüncelle(Request $request,$id) {

    $ad= $request->ad;
    $soyad= $request->soyad;
    $email= $request->email;
    $ünvan= $request->ünvan;
    $sifre = $request->sifre;
    $sifreiki=password_hash($sifre,PASSWORD_DEFAULT);
    DB::update('update danısman set ad = ?,soyad=?,email=?,ünvan=?,sifre=? where numara = ?',[$ad,$soyad,$email,$ünvan,$sifreiki,$id]);
        $dataeksi= DB::table('danısman')->where('numara', $id)->get();

        return view('danısmanprofil',array('numara'=>$dataeksi));
}
public function guncelledanısman ($id) {

    $data= DB::table('danısman')->where('numara', $id)->get();
    return view('danısmanguncelle',array('numara'=>$data));

}
public function store(Request $request,$id,$idiki)
{
    $tasüc= DB::table('pdfs')->where('konuid', $idiki)->value('konuid');
if( $tasüc==NULL){
    $tas= DB::table('konu')->where('id', $idiki)->value('danısmannumara');
    $tasiki= DB::table('konu')->where('id', $idiki)->value('konu');
    $data=new pdf();
    $file=$request->file;
    $fileiki=$request->fileiki;
    if($file->getClientOriginalExtension()=='pdf'&&$fileiki->getClientOriginalExtension()=='doc'){



$filename=time().'.'.$file->getClientOriginalExtension();

            $request->file->move('assets',$filename);

            $data->file=$filename;


            $filenameiki=rand(0,255).'.'.$fileiki->getClientOriginalExtension();

                        $request->fileiki->move('assets',$filenameiki);

                        $data->fileiki=$filenameiki;


            $data->ogrencinumara=$id;
            $data->danısmannumara=$tas;
            $data->konu=$tasiki;
            $data->onay='beklemede';
            $data->konuid=$idiki;


            $data->save();

            return redirect('raporeklemeiki/'.$id.'/'.$idiki)->with('status','Rapor Gönderimi Başarılı' );

    }
    else{
        return redirect('raporeklemeiki/'.$id.'/'.$idiki)->with('status','Dosya Biçimleri Yanlış. Kontrol Ediniz' );

    }
}
else{
    return redirect('raporeklemeiki/'.$id.'/'.$idiki)->with('status','Bu Dosya Gönderimi Yapılmıştır' );

}


}


public function goster()
{

    $data=pdf::all();

    return view('pdfListele',compact('data'));
}


   public function download(Request $request,$file)
{


return response()->download(public_path('assets/'.$file));
}



public function goruntule($id)
{
    $data=Pdf::find($id);

    return view('pdfGoster',compact('data'));


}
public function goruntuleiki($id)
{
    $data=Pdf::find($id);

    return view('pdfGosteriki',compact('data'));


}
public function raporekranı ($id) {


    $data= DB::table('onayliogrenci')->where('numara', $id)->get();
    $dataiki= DB::table('konu')->where('ogrencinumara', $id)->where('onay','onaylandı')->get();
    return view('ogrencirapor',array('numara'=>$data,'konular'=>$dataiki));


}
public function danısmanrapor ($id) {

   // $datas=pdf::all();
    $datas= DB::table('pdfs')->where('danısmannumara', $id)->where('onay', 'beklemede')->get();
    $data= DB::table('danısman')->where('numara', $id)->get();
    return view('danısmanrapor',array('numara'=>$data,'datas'=>$datas));

}
public function donemproje ($id) {
    $null='bos';

    $ogrenci= DB::select('select * from onayliogrenci where danısman = ?', [$null]);
    $danisman= DB::select('select * from danısman');
    $data= DB::table('yonetıcıs')->where('numara', $id)->get();
    return view('donemislemleri',array('numara'=>$data,'ogrenci'=>$ogrenci,'danisman'=>$danisman));

}
public function atamayap(Request $request,$id) {
    $null='bos';
    $dolu='dolu';
    $ogrenci= DB::select('select * from onayliogrenci where danısman = ?', [$null]);
    $danisman= DB::select('select * from danısman');

    //$data= DB::table('danısman')->where('id', 1)->value('numara');
$numara=0;

   // $datas= DB::table('onayliogrenci')->where('numara', '191307003')->value('numara');
   for($indis=0; $indis<count($danisman);$indis++)
   {
       for($i=0; $i<=4;$i++){




        if($numara>=count($ogrenci)){

            break;
                       }

          DB::table('donem')->insert(
        array(

            'danısmannumara'   =>$danisman[$indis]->numara,
            'ogrencinumara'     =>$ogrenci[$numara]->numara,
            'donem'     =>$request->input('ColumnType')



        ));

  DB::update('update onayliogrenci set danısman=? where numara = ?',[$dolu,$ogrenci[$numara]->numara]);
        $numara=$numara+1;
          }
   }

        $dataeksi= DB::table('yonetıcıs')->where('numara', $id)->get();

        return view('SistemYöneticisi',array('numara'=>$dataeksi));
}
public function konuekranı($id) {
    $data= DB::table('onayliogrenci')->where('numara', $id)->get();


    return view('konu',array('numara'=>$data));
}
function countOccurrences($str, $word)
{
    $a = explode(" ", $str);
    $dizi = array();
    $count = 0;
    for ($i = 0; $i < sizeof($a); $i++)
    {
        $b = explode(" ", $word);
        for ($k = 0; $k < sizeof($b); $k++)
        {
            if ($b[$k] == $a[$i])
            {
                $count++;
                array_push($dizi, $a[$i]);
            }
        }
    }
    //print_r($dizi);
    $dizi = array_unique($dizi);
    //print_r($dizi);
    $sonuc= array_count_values($dizi);
    return count($sonuc);
    //return $count;
}


public function strU($str)
{

    $dizi = array();
    $a = explode(" ", $str);
    for ($i = 0; $i < sizeof($a); $i++)
    {
        array_push($dizi, $a[$i]);
    }
    $dizi = array_unique($dizi);
    $sonuc= array_count_values($dizi);
    return count($sonuc);
}
public function konubelirle(Request $request,$id) {

    $datas= DB::select('select * from konu');
    if($datas==NULL){
        $data= DB::table('onayliogrenci')->where('numara', $id)->value('numara');
        $datas= DB::table('donem')->where('ogrencinumara', $id)->value('danısmannumara');
        $onay='beklemede';
    $konu=$request->konu;
    $baslık=$request->baslık;
    $anahtar=$request->anahtar;
    $materyel=$request->materyel;
    $sayac=str_word_count($konu);
    $sayaciki=str_word_count($materyel);
    $sayacüc=str_word_count($anahtar);
    if($sayac>=200&&$sayaciki>=300&&$sayacüc==5){

        DB::table('konu')->insert(
            array(

                'konu'   =>$konu,
                'ogrencinumara'     =>$data,
                'danısmannumara'     =>$datas,
                'baslık'     =>$baslık,
                'anahtar1'     =>$anahtar,
                'materyel'     =>$materyel,
                'onay'     =>$onay




            ));

            $dataiki= DB::table('onayliogrenci')->where('numara', $id)->get();
            return view('Öğrenci',array('numara'=>$dataiki));
        }
    }
    else{
    for($indis=0; $indis<count($datas);$indis++){

    $str = $datas[$indis]->konu;
    $word = $request->konu;


    $kelime=(int)$this->strU($str);


    $benzer=(int)$this->countOccurrences($str, $word);

    $sonuc=(100*$benzer)/$kelime;


    if ($sonuc > 30 ) {
        return redirect('konuekranı/'.$id)->with('status','Konu Benzeşmesi Olduğu İçin Öneriniz Otamatik Olarak Reddedildi' );
    }
    else {
        $striki = $datas[$indis]->anahtar1;
        $wordiki = $request->anahtar;


        $kelimeiki=(int)$this->strU($striki);


        $benzeriki=(int)$this->countOccurrences($striki, $wordiki);

        $sonuciki=(100*$benzeriki)/$kelimeiki;
        if ($sonuciki > 40 ) {
            return redirect('konuekranı/'.$id)->with('status','Anahtar Kelime Benzeşmesi Olduğu İçin Öneriniz Otamatik Olarak Reddedildi' );
        }
        else {

            $strüc = $datas[$indis]->baslık;
            $wordüc = $request->baslık;


            $kelimeüc=(int)$this->strU($strüc);


            $benzerüc=(int)$this->countOccurrences($strüc, $wordüc);

            $sonucüc=(100*$benzerüc)/$kelimeüc;

            if ($sonucüc > 30 ) {
                return redirect('konuekranı/'.$id)->with('status','Başlık Benzeşmesi Olduğu İçin Öneriniz Otamatik Olarak Reddedildi' );
            }



            }






    }
    }
    $data= DB::table('onayliogrenci')->where('numara', $id)->value('numara');
    $datas= DB::table('donem')->where('ogrencinumara', $id)->value('danısmannumara');
    $onay='beklemede';
$konu=$request->konu;
$baslık=$request->baslık;
$anahtar=$request->anahtar;
$materyel=$request->materyel;
$sayac=str_word_count($konu);
$sayaciki=str_word_count($materyel);
$sayacüc=str_word_count($anahtar);
if($sayac>=200&&$sayaciki>=300&&$sayacüc==5){

    DB::table('konu')->insert(
        array(

            'konu'   =>$konu,
            'ogrencinumara'     =>$data,
            'danısmannumara'     =>$datas,
            'baslık'     =>$baslık,
            'anahtar1'     =>$anahtar,
            'materyel'     =>$materyel,
            'onay'     =>$onay




        ));

        $dataiki= DB::table('onayliogrenci')->where('numara', $id)->get();
        return view('Öğrenci',array('numara'=>$dataiki));
}
else{
    return redirect('konuekranı/'.$id)->with('status','Kelime Sayısına Dikkat Ediniz' );
    $dataiki= DB::table('onayliogrenci')->where('numara', $id)->get();
    return view('Öğrenci',array('numara'=>$dataiki,'konular'=>$konu));
}
























    }



}
public function konuonay($id) {

    $data= DB::table('danısman')->where('numara', $id)->get();
    $konu= DB::table('konu')->where('danısmannumara', $id)->where('onay', 'beklemede')->get();
    return view('konuonay',array('numara'=>$data,'konular'=>$konu));
}
public function onayla($id,$idiki){

    $ad='onaylandı';

    DB::update('update konu set onay=? where id = ?',[$ad,$idiki]);


       $data= DB::table('danısman')->where('numara', $id)->get();
       $konu= DB::table('konu')->where('danısmannumara', $id)->where('onay', 'beklemede')->get();
       return view('konuonay',array('numara'=>$data,'konular'=>$konu));

}
public function düzenleiste($id,$idiki){

    $data= DB::table('danısman')->where('numara', $id)->get();
    $iki= DB::table('konu')->where('id', $idiki)->get();

       return view('düzenle',array('numara'=>$data,'konu'=>$iki));

}
public function düzen(Request $request,$id,$idiki){

$a=$request->acıklama;

    DB::update('update konu set acıklama=? where id = ?',[$a,$idiki]);

    $ad='düzenle';

    DB::update('update konu set onay=? where id = ?',[$ad,$idiki]);

    $data= DB::table('danısman')->where('numara', $id)->get();
    $konu= DB::table('konu')->where('danısmannumara', $id)->where('onay', 'beklemede')->get();

       return view('konuonay',array('numara'=>$data,'konular'=>$konu));

}
public function rediste($id,$idiki){

    $data= DB::table('danısman')->where('numara', $id)->get();
    $iki= DB::table('konu')->where('id', $idiki)->get();

       return view('red',array('numara'=>$data,'konu'=>$iki));

}
public function red(Request $request,$id,$idiki){

    $a=$request->acıklama;

        DB::update('update konu set acıklama=? where id = ?',[$a,$idiki]);

        $ad='red';

        DB::update('update konu set onay=? where id = ?',[$ad,$idiki]);

        $data= DB::table('danısman')->where('numara', $id)->get();
        $konu= DB::table('konu')->where('danısmannumara', $id)->where('onay', 'beklemede')->get();

           return view('konuonay',array('numara'=>$data,'konular'=>$konu));

    }
    public function konular($id){
        $data= DB::table('onayliogrenci')->where('numara', $id)->get();


        $konu= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'beklemede')->get();
        $konudort= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'onaylandı')->get();
        $konuiki= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'red')->get();
        $konuüc= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'düzenle')->get();
           return view('eskikonular',array('numara'=>$data,'konular'=>$konu,'konulariki'=>$konuiki,'konularüc'=>$konuüc,'konulardort'=>$konudort));

    }
    public function düzenlenmeisteği($id,$idiki){

        $data= DB::table('onayliogrenci')->where('numara', $id)->get();
        $iki= DB::table('konu')->where('id', $idiki)->get();

           return view('düzenlenmeisteği',array('numara'=>$data,'konu'=>$iki));

    }
    public function konudüzenleiki(Request $request,$id,$idiki){

        $data= DB::table('onayliogrenci')->where('numara', $id)->get();


        $onay='beklemede';
        $konu=$request->konu;
        $baslık=$request->baslık;
        $anahtar=$request->anahtar;
        $materyel=$request->materyel;
        $sayac=str_word_count($konu);
        $sayaciki=str_word_count($materyel);
        $sayacüc=str_word_count($anahtar);
        if($sayac>=200&&$sayaciki>=300&&$sayacüc==5){

            DB::update('update konu set konu=?,baslık=?,anahtar1=?,materyel=?,onay=?  where id = ?',[$konu,$baslık,$anahtar,$materyel,$onay,$idiki]);


        }








        $konu= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'beklemede')->get();
        $konudort= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'onaylandı')->get();
        $konuiki= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'red')->get();
        $konuüc= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'düzenle')->get();
           return view('eskikonular',array('numara'=>$data,'konular'=>$konu,'konulariki'=>$konuiki,'konularüc'=>$konuüc,'konulardort'=>$konudort));


        }
        public function raporeklemeiki($id,$idiki){

            $data= DB::table('onayliogrenci')->where('numara', $id)->get();
            $iki= DB::table('konu')->where('id', $idiki)->get();

               return view('ogrenciraporyukle',array('numara'=>$data,'konu'=>$iki));

        }
        public function raporonayla($id,$idiki){
            $data= DB::table('danısman')->where('numara', $idiki)->get();
            $iki= DB::table('pdfs')->where('id', $id)->get();

               return view('raporonayekrani',array('numara'=>$data,'konu'=>$iki));


            }
            public function redrapor(Request $request,$id,$idiki){

                $a=$request->acıklama;

                    DB::update('update pdfs set acıklama=? where id = ?',[$a,$idiki]);
                    $ad='red';

                    DB::update('update pdfs set onay=? where id = ?',[$ad,$idiki]);

                    $data= DB::table('danısman')->where('numara', $id)->get();
                    $konu= DB::table('pdfs')->where('danısmannumara', $id)->where('onay', 'beklemede')->get();

                       return view('danısmanrapor',array('numara'=>$data,'datas'=>$konu));

                }
                public function oncekiraporlar($id,$idiki){

                    /*$konu= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'beklemede')->get();
                    $konudort= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'onaylandı')->get();
                    $konuiki= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'red')->get();
                    $konuüc= DB::table('konu')->where('ogrencinumara', $id)->where('onay', 'düzenle')->get();
                       return view('eskikonular',array('numara'=>$data,'konular'=>$konu,'konulariki'=>$konuiki,'konularüc'=>$konuüc,'konulardort'=>$konudort));*/
                    $data= DB::table('onayliogrenci')->where('numara', $id)->get();
                    $iki= DB::table('pdfs')->where('ogrencinumara', $id)->where('onay', 'beklemede')->get();
                    $ikiiki= DB::table('pdfs')->where('ogrencinumara', $id)->where('onay', 'onaylandı')->get();
                    $ikiüc= DB::table('pdfs')->where('ogrencinumara', $id)->where('onay', 'red')->get();

                       return view('oncekiraporlar',array('numara'=>$data,'datas'=>$iki,'datasiki'=>$ikiiki,'datasüc'=>$ikiüc));

                }
                public function onaylaiki($id,$idiki){

                    $ad='onaylandı';

                    DB::update('update pdfs set onay=? where id = ?',[$ad,$id]);

                    $data= DB::table('danısman')->where('numara', $idiki)->get();
                    $konu= DB::table('pdfs')->where('danısmannumara', $idiki)->where('onay', 'beklemede')->get();

                       return view('danısmanrapor',array('numara'=>$data,'datas'=>$konu));

                }
                public function raporeklemeüc($id,$idiki){

                    $data= DB::table('onayliogrenci')->where('numara', $id)->get();

                    $iki= DB::table('konu')->where('id', $idiki)->get();

                       return view('ogrenciraporyuklered',array('numara'=>$data,'konu'=>$iki));

                }
                public function storeiki(Request $request,$id,$idiki)
{
    $tasüc= DB::table('pdfs')->where('konuid', $idiki)->where('onay','onaylandı')->value('id');
    $tasdort= DB::table('pdfs')->where('konuid', $idiki)->where('onay','beklemede')->value('id');

if( $tasüc==NULL&&$tasdort==NULL){
    $tas= DB::table('konu')->where('id', $idiki)->value('danısmannumara');
    $tasiki= DB::table('konu')->where('id', $idiki)->value('konu');
    $data=new pdf();
    $file=$request->file;
    $fileiki=$request->fileiki;
    if($file->getClientOriginalExtension()=='pdf'&&$fileiki->getClientOriginalExtension()=='doc'){



$filename=time().'.'.$file->getClientOriginalExtension();

            $request->file->move('assets',$filename);

            $data->file=$filename;


            $filenameiki=rand(0,255).'.'.$fileiki->getClientOriginalExtension();

                        $request->fileiki->move('assets',$filenameiki);

                        $data->fileiki=$filenameiki;


            $data->ogrencinumara=$id;
            $data->danısmannumara=$tas;
            $data->konu=$tasiki;
            $data->onay='beklemede';
            $data->konuid=$idiki;


            $data->save();

            return redirect('raporeklemeüc/'.$id.'/'.$idiki)->with('status','Rapor Gönderimi Başarılı' );

    }
    else{
        return redirect('raporeklemeüc/'.$id.'/'.$idiki)->with('status','Dosya Biçimleri Yanlış. Kontrol Ediniz' );

    }
}
else{
    return redirect('raporeklemeüc/'.$id.'/'.$idiki)->with('status','Bu Dosya Gönderimi Yapılmıştır' );

}


}
public function danısmanoncekiraporlar ($id,$idiki) {

    $ono= DB::table('pdfs')->where('id', $id)->value('ogrencinumara');

    $datas= DB::table('pdfs')->where('danısmannumara', $idiki)->where('ogrencinumara', $ono)->get();
    $data= DB::table('danısman')->where('numara', $idiki)->get();
    return view('danısmanraporiki',array('numara'=>$data,'datas'=>$datas));


}
public function tezekranı ($id) {


    $data= DB::table('onayliogrenci')->where('numara', $id)->get();
    $dataiki= DB::table('pdfs')->where('ogrencinumara', $id)->where('onay','onaylandı')->get();
    return view('ogrencitez',array('numara'=>$data,'datas'=>$dataiki));


}
public function tezyükleme($id,$idiki){

    $data= DB::table('onayliogrenci')->where('numara', $id)->get();
    $iki= DB::table('pdfs')->where('konuid', $idiki)->where('onay', 'onaylandı')->get();

       return view('tezeklenmesi',array('numara'=>$data,'konu'=>$iki));

}
public function storeüc(Request $request,$id,$idiki)
{
    $ikibes= DB::table('pdfs')->where('ogrencinumara', $id)->where('onay','onaylandı')->value('konuid');
    $tasüc= DB::table('tezs')->where('konuid', $idiki)->value('konuid');
if( $tasüc==NULL){
    $tas= DB::table('konu')->where('id', $idiki)->value('danısmannumara');
    $tasiki= DB::table('konu')->where('id', $idiki)->value('konu');
    $data=new tez();
    $file=$request->file;
    $fileiki=$request->fileiki;
    if($file->getClientOriginalExtension()=='pdf'&&$fileiki->getClientOriginalExtension()=='doc'){



$filename=time().'.'.$file->getClientOriginalExtension();

            $request->file->move('assets',$filename);

            $data->file=$filename;


            $filenameiki=rand(0,255).'.'.$fileiki->getClientOriginalExtension();

                        $request->fileiki->move('assets',$filenameiki);

                        $data->fileiki=$filenameiki;


            $data->ogrencinumara=$id;
            $data->danısmannumara=$tas;
            $data->konu=$tasiki;
            $data->onay='beklemede';
            $data->konuid=$idiki;



            $data->save();
            return redirect('tezyükleme/'.$id.'/'.$ikibes)->with('status','Rapor Gönderimi Başarılı' );

    }
    else{
        return redirect('tezyükleme/'.$id.'/'.$ikibes)->with('status','Dosya Biçimleri Yanlış. Kontrol Ediniz' );

    }
}
else{
    return redirect('tezyükleme/'.$id.'/'.$ikibes)->with('status','Bu Dosya Gönderimi Yapılmıştır' );

}

}
public function danısmantez ($id) {

    // $datas=pdf::all();
     $datas= DB::table('tezs')->where('danısmannumara', $id)->where('onay', 'beklemede')->get();
     $data= DB::table('danısman')->where('numara', $id)->get();
     return view('danısmantez',array('numara'=>$data,'datas'=>$datas));

 }
 public function onaylaüc($id,$idiki){

    $ad='onaylandı';

    DB::update('update tezs set onay=? where id = ?',[$ad,$id]);

    $data= DB::table('danısman')->where('numara', $idiki)->get();
    $konu= DB::table('tezs')->where('danısmannumara', $idiki)->where('onay', 'beklemede')->get();

       return view('danısmanrapor',array('numara'=>$data,'datas'=>$konu));

}
public function tezonayla($id,$idiki){
    $data= DB::table('danısman')->where('numara', $idiki)->get();
    $iki= DB::table('tezs')->where('id', $id)->get();

       return view('tezonayekrani',array('numara'=>$data,'konu'=>$iki));


    }
    public function redtez(Request $request,$id,$idiki){

        $a=$request->acıklama;

            DB::update('update tezs set acıklama=? where id = ?',[$a,$idiki]);
            $ad='red';

            DB::update('update tezs set onay=? where id = ?',[$ad,$idiki]);

            $data= DB::table('danısman')->where('numara', $id)->get();
            $konu= DB::table('tezs')->where('danısmannumara', $id)->where('onay', 'beklemede')->get();

               return view('danısmantez',array('numara'=>$data,'datas'=>$konu));

        }
        public function oncekitezler($id,$idiki){


            $data= DB::table('onayliogrenci')->where('numara', $id)->get();
            $iki= DB::table('tezs')->where('ogrencinumara', $id)->where('onay', 'beklemede')->get();
            $ikiiki= DB::table('tezs')->where('ogrencinumara', $id)->where('onay', 'onaylandı')->get();
            $ikiüc= DB::table('tezs')->where('ogrencinumara', $id)->where('onay', 'red')->get();

               return view('oncekitezler',array('numara'=>$data,'datas'=>$iki,'datasiki'=>$ikiiki,'datasüc'=>$ikiüc));

        }
        public function tezeklemeüc($id,$idiki){

            $data= DB::table('onayliogrenci')->where('numara', $id)->get();

            $iki= DB::table('konu')->where('id', $idiki)->get();

               return view('ogrencitezyuklered',array('numara'=>$data,'konu'=>$iki));

        }
        public function storedört(Request $request,$id,$idiki)
        {
            $tasüc= DB::table('tezs')->where('konuid', $idiki)->where('onay','onaylandı')->value('id');
            $tasdort= DB::table('tezs')->where('konuid', $idiki)->where('onay','beklemede')->value('id');

        if( $tasüc==NULL&&$tasdort==NULL){
            $tas= DB::table('konu')->where('id', $idiki)->value('danısmannumara');
            $tasiki= DB::table('konu')->where('id', $idiki)->value('konu');
            $data=new tez();
            $file=$request->file;
            $fileiki=$request->fileiki;
            if($file->getClientOriginalExtension()=='pdf'&&$fileiki->getClientOriginalExtension()=='doc'){



        $filename=time().'.'.$file->getClientOriginalExtension();

                    $request->file->move('assets',$filename);

                    $data->file=$filename;


                    $filenameiki=rand(0,255).'.'.$fileiki->getClientOriginalExtension();

                                $request->fileiki->move('assets',$filenameiki);

                                $data->fileiki=$filenameiki;


                    $data->ogrencinumara=$id;
                    $data->danısmannumara=$tas;
                    $data->konu=$tasiki;
                    $data->onay='beklemede';
                    $data->konuid=$idiki;


                    $data->save();

                    return redirect('tezeklemeüc/'.$id.'/'.$idiki)->with('status','Rapor Gönderimi Başarılı' );

            }
            else{
                return redirect('tezeklemeüc/'.$id.'/'.$idiki)->with('status','Dosya Biçimleri Yanlış. Kontrol Ediniz' );

            }
        }
        else{
            return redirect('tezeklemeüc/'.$id.'/'.$idiki)->with('status','Bu Dosya Gönderimi Yapılmıştır' );

        }
    }
    public function danısmanoncekitezler ($id,$idiki) {

        $ono= DB::table('tezs')->where('id', $id)->value('ogrencinumara');

        $datas= DB::table('tezs')->where('danısmannumara', $idiki)->where('ogrencinumara', $ono)->get();
        $data= DB::table('danısman')->where('numara', $idiki)->get();
        return view('danısmanteziki',array('numara'=>$data,'datas'=>$datas));


    }
    public function danısmantumogrenciler ($id){
        $data= DB::table('danısman')->where('numara', $id)->get();
        $datas= DB::table('donem')->where('danısmannumara', $id)->get();
        return view('tümogrenciler',array('numara'=>$data,'datas'=>$datas));
    }
    public function ogrenciprofildört ($id,$idiki){
        $data= DB::table('danısman')->where('numara', $id)->get();
        $datas= DB::table('onayliogrenci')->where('numara', $idiki)->get();
        return view('tumogrencilerprofil',array('numara'=>$data,'datas'=>$datas));
    }
    public function cıkısyap (){

        return view('gırıs');
    }
    public function danısmangoruntule ($id){
        $data= DB::table('onayliogrenci')->where('numara', $id)->get();
        $datass= DB::table('donem')->where('ogrencinumara', $id)->value('danısmannumara');
        $datas= DB::table('danısman')->where('numara', $datass)->get();
        return view('danısmanprofiliiki',array('numara'=>$data,'datas'=>$datas));
    }
    public function yonetıcısdanısmanlar ($id){
        $data= DB::table('yonetıcıs')->where('numara', $id)->get();
        $datas= DB::select('select * from danısman ');
        return view('yoneticisdns',array('numara'=>$data,'datas'=>$datas));
    }
    public function yonetıcısogrenciler ($id){
        $data= DB::table('yonetıcıs')->where('numara', $id)->get();
        $datas= DB::select('select * from onayliogrenci ');
        return view('yoneticisogr',array('numara'=>$data,'datas'=>$datas));
    }
    public function yonetıcısyonetıcıs($id){
        $data= DB::table('yonetıcıs')->where('numara', $id)->get();
        $datas= DB::select('select * from yonetıcıs ');
        return view('yoneticisynt',array('numara'=>$data,'datas'=>$datas));
    }
    public function projeilerlemesiüc($id){
        $data= DB::table('yonetıcıs')->where('numara', $id)->get();
        $datas= DB::select('select * from konu ');
        $datasiki= DB::select('select * from pdfs ');
        $datasüc= DB::select('select * from tezs ');
        return view('yoneticiislemler',array('numara'=>$data,'datas'=>$datas,'datasiki'=>$datasiki,'datasüc'=>$datasüc));
    }
    public function danısmananasayfa ($id){
        $data= DB::table('danısman')->where('numara', $id)->get();

        return view('danışman',array('numara'=>$data));
    }


}
