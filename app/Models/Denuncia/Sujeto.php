<?php
namespace App\Models\Denuncia;
use Illuminate\Database\Eloquent\Model;
class Sujeto extends Model
{
    protected $table = 'pol_hechopersona';
    protected $fillable = [
        'hecho_id',
        'persona_id',
        'estado',
        'descripcion',
        'persona_juridica_id',
        'persona_desconocida_id',
        'relacion_victima_id',
        'nivel_educacion_id',
        'grupo_vulnerable_id',
        'grado_discapacidad_id',
        'tipo_sujeto_id',
        'fallecido',
        'estado_procesal',
        'autoidentificacion_id'
    ];
    //protected $guarded = [];
    public function hecho() {
        return $this->belongsTo('App\Models\Denuncia\Hecho','hecho_id');
    }
    public function persona() {
        return $this->belongsTo('App\Models\Rrhh\RrhhPersona','persona_id');
    }
    public function juridica() {
        return $this->belongsTo('App\Models\Rrhh\RrhhPersonaJuridica','persona_juridica_id');
    }
    public function desconocida() {
        return $this->belongsTo('App\Models\Rrhh\RrhhPersonaDesconocida','persona_desconocida_id');
    }
    public function tiposujeto() {
        return $this->belongsTo('App\Models\Denuncia\TipoSujeto', 'tipo_sujeto_id');
    }  
    public function medidasProteccion()
    {
        return $this->belongsToMany('App\Models\Denuncia\MedidaProteccion', 'hechopersona_medidasproteccion',  'hechopersona_id', 'medidaproteccion_id' )
                    ->withPivot('medidaproteccion_id', 'hechopersona_id', 'estado');
    } 
    protected $appends = array( 
        'tipango',
        //'age',
        'denunciante', //natural, juridica, desconocida
        'denunciantecss',
        'sexotxt',
        //'sexo',
        //'celular',
        //'domicilio',
        'tipangocss',
        //'aplicarmedidas', //0: ninguna, 1: niños, 2: mujeres, 3 etc
        'tieneproteccion', //0: no, >0 si
    );
    public function getTipangoAttribute(){
       return $this->tiposujeto->nombre;
    } 
    /*
    public function getFullnameAttribute(){ 
        if($this->persona_id){ 
            return $this->persona->fullname;
        }
        if($this->persona_juridica_id){
           return $this->juridica->fullname;
        }
        if($this->persona_desconocida_id){
            return $this->desconocida->fullname;
        }
        return 'error';       
    } 
    public function getCiAttribute(){ 
       if($this->persona_id){
            return $this->persona->n_documento;
        }
        if($this->persona_juridica_id){
           return $this->juridica->nit;
        }
        if($this->persona_desconocida_id){
            return ' ';
        }
        return 'error'; 
    } 
    */
    /*
    public function getAgeAttribute(){ 
       if($this->persona_id){
            return \Carbon\Carbon::parse($this->persona->f_nacimiento)->age;
        }
        if($this->persona_juridica_id){
           return null;
        }
        if($this->persona_desconocida_id){
            //return \Carbon\Carbon::parse($this->desconocida->f_nacimiento)->age;
            return null;
        }
        return 'error'; 
    } 
    */
    /*
    public function getSexoAttribute(){  
        if($this->persona_id){ 
            return $this->persona->sexo;
        }
        if($this->persona_juridica_id){
           return null;
        }
        if($this->persona_desconocida_id){
            return null;
        }
        return 'error';
    } 
    */
    public function getSexotxtAttribute(){  
        if($this->busqueda_sexo=='M'){ 
            return 'Masculino';
        }elseif($this->busqueda_sexo=='F'){
            return 'Femenino';
        }else{
            return '';
        }
    } 
    /* 
    public function getCelularAttribute(){ 
        if($this->persona_id){ 
            return $this->persona->celular;
        }
        if($this->persona_juridica_id){
           return $this->juridica->telefono;
        }
        if($this->persona_desconocida_id){
            return null;
        }
        return 'error';
    }  
    */   
    /*
    public function getDomicilioAttribute(){ 
        if($this->persona_id){ 
            return $this->persona->domicilio;
        }
        if($this->persona_juridica_id){
           return $this->juridica->domicilio;
        }
        if($this->persona_desconocida_id){
            return null;
        }
        return 'error';
    }   
    */
    public function getDenuncianteAttribute(){ 
        if($this->es_persona==0){
            return 'Juridica';
        }elseif($this->es_persona==1){
            return 'Natural';
        }else{
            return 'Desconocida';
        }
        /*
        if($this->persona_id){ //personas
            return 'Natural';
        }
        if($this->persona_juridica_id){
            return 'Juridica';
        }
        if($this->persona_desconocida_id){
            return 'Desconocida';
        }
        return 'error';
        */
    }   
    public function getTipangocssAttribute(){ 
        if($this->tipo_sujeto_id ==3 )//victima
            return 'badge-danger' ;
        if( $this->tipo_sujeto_id==4) //testigo
            return 'badge-info' ;
        if( $this->tipo_sujeto_id ==2) //denunciado
            return 'badge-warning' ;
         if( $this->tipo_sujeto_id ==1 ) //denunciante
            return 'badge-success' ;
        return 'badge-light' ;
    }
    public function getDenunciantecssAttribute(){ 
        if($this->es_persona==0){
            return 'Juridica';
        }elseif($this->es_persona==1){
            return 'badge-secondary';
        }else{
            return 'badge-dark';
        }       
    }
    /*
    public function getAplicarmedidasAttribute(){ 
        ////0: ninguna, 1: niños, 2: mujeres, 3 etc
        if($this->persona_id){ //personas
            //$edad = \Carbon\Carbon::parse($this->persona->f_nacimiento)->age;
             $edad_en_fecha_echo = \Carbon\Carbon::parse($this->created_at)->diff(\Carbon\Carbon::parse($this->persona->f_nacimiento ))->format('%y');
           if( $edad_en_fecha_echo <18 ){
                return 1;
           }
           if($this->persona->sexo == 'F'){
                return 2;
           }
           return 0;
        }else{
            return 0;
         
        }
       return 0;
    } 
    */
    public function getTieneproteccionAttribute(){ 
        return $this->medidasProteccion->count();
    } 
}