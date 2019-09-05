---
title: API DOCUMENTACIÓN

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='https://www.fiscalia.gob.bo/'>NINISTERIO PÚBLICO @2019</a>
---
<!-- START_INFO -->
# Documentación Fiscalía General del Estado

<h2>Bienvenidos al Generador de documentacion API REST FULL.</h2>

<!-- END_INFO -->

#Métodos Sujetos Procesales


<!-- START_a693ec0cce3fe5d623626615f51838bd -->
## GET obtención Sujetos Procesales.

Para la Obtención de los Sujeto Procesales se debe mandar una peticion a la <b>url</b> descrita abajo
 enviando los sigientes parametros a la variable tipo.<br>
 <b>tipo=1 (Persona Denunciante)</b><br>
 <b>tipo=2 (Persona Denunciado)</b><br>
 <b>tipo=3 (Persona Victima)</b><br>
 <b>tipo=4 (Persona Testigo)</b>

> Example request:

```bash
curl -X GET -G "http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/sujetosProcesales?tipo=1" \
    -H "Authorization: Bearer " \
    -H "Api-Version: v2"
```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/sujetosProcesales?tipo=1");

let headers = {
    "Authorization": "Bearer ",
    "Api-Version": "v2",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "página_actual": 1,
    "datos": [
        {
            "es_persona": 1,
            "provincia_nacimiento": "PEDRO DOMINGO MURILLO",
            "municipio_nacimiento": "NUESTRA SEÑORA DE LA PAZ",
            "provincia_residencia": "PEDRO DOMINGO MURILLO",
            "municipio_residencia": "NUESTRA SEÑORA DE LA PAZ",
            "n_documento": "9247139",
            "nombre": "JESUS REYNALDO",
            "ap_paterno": "MENDOZA",
            "ap_materno": "ATAHUACHI",
            "ap_esposo": null,
            "sexo": "M",
            "fecha_nacimiento": "1991-01-06",
            "estado_civil": null,
            "domicilio": null,
            "telefono": null,
            "celular": "75205679",
            "profesion_ocupacion": null,
            "pueblo_originario": null,
            "lugar_trabajo": null,
            "domicilio_laboral": null,
            "telefono_laboral": null,
            "alias": null,
            "estatura": null,
            "tez": null,
            "edad": null,
            "vestimenta": null,
            "senia": null,
            "peso": null,
            "cabello": null,
            "genero": null,
            "email": null,
            "ojos": null,
            "ciudadano_digital": 0,
            "relacion_victima": "PADRE",
            "nivel_educacion": "SECUNDARIA",
            "grupo_vulnerable": "ADULTO MAYOR",
            "grado_discapacidad": "MILTIPLE",
            "estado_procesal": null
        },
        {
            "es_persona": 0,
            "provincia": "LUIS CALVO",
            "municipio": "VILLA VACA GUZMAN (MUYUPAMPA)",
            "razon_social": "Paucek Ltd",
            "nit": "626394652",
            "domicilio": "4856 Randy Points Suite 194\nNew Rosannastad, NJ 46481",
            "telefono": "+3877697129878",
            "relacion_victima": "HIJO(A)",
            "nivel_educacion": "MAESTRIA",
            "grupo_vulnerable": "NIÑO - ADOLECENTE",
            "grado_discapacidad": "AUDITIVA",
            "estado_procesal": null
        },
        {
            "es_persona": 2,
            "pais": "ANTILLAS NEERLANDESAS",
            "nombre": "Prof. Francisco Strosin IV",
            "ap_paterno": "Stephanie",
            "ap_materno": "Haag",
            "descripcion": "Qui nostrum sed atque debitis nulla qui alias non. Delectus sit omnis quia non debitis. Sed enim et neque sunt laboriosam. Ipsa fuga sit voluptatem et incidunt alias neque voluptas.",
            "relacion_victima": "PERSONAL ISNTITUCIONAL",
            "nivel_educacion": "TÉCNICO",
            "grupo_vulnerable": "POBLACION CON DISCAPACIDAD",
            "grado_discapacidad": "INTELECTUAL",
            "estado_procesal": null
        }
    ],
    "url_primera_pagina": "http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/sujetosProcesales?tipo=1&page=1",
    "desde": 1,
    "ultima_pagina": 1,
    "url_ultima_pagina": "http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/sujetosProcesales?tipo=1&page=1",
    "url_pagina_siguiente": null,
    "path": "http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/sujetosProcesales",
    "por_pagina": 5,
    "purl_pagina_anterior": null,
    "a": 3,
    "total": 3
}
```

### HTTP Request
`GET api/v2/casos/{hecho}/sujetosProcesales?tipo={sujetoProcesal}`


<!-- END_a693ec0cce3fe5d623626615f51838bd -->

<!-- START_a71dcd3d6f16c5c1b0e42b270fa7547d -->
## Metodo POST para registro de Sujetos Procesales.

En este método debe mandarse la información Generada en las Instituciones con acceso a esta API
cada vez que se genere un nuevo tipo de Sujeto Procesal se de mandar 2 parametros adicionales
como ser el <b>tipo=</b> y el <b>es_persona=</b> donde los parámetros van de acuerdo a lo siguiente<br>
<b>tipo=1 (Persona Denunciante)</b><br>
<b>tipo=2 (Persona Denunciado)</b><br>
<b>tipo=3 (Persona Victima)</b><br>
<b>tipo=4 (Persona Testigo)</b><br>
<b>es_persona=0 (Persona Juridica)</b><br>
<b>es_persona=1 (Persona natural)</b><br>
<b>es_persona=2 (Persona Desconocida y/o Extranjera)</b><br>

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/sujetosProcesales?tipo=1&es_persona=2" \
    -H "Authorization: Bearer " \
    -H "Api-Version: v2"
```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/sujetosProcesales?tipo=1&es_persona=2");

let headers = {
    "Authorization": "Bearer ",
    "Api-Version": "v2",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "error": {
        "n_documento": [
            "El campo n_documento es obligatorio."
        ],
        "tipo_documento": [
            "El campo tipo_documento es obligatorio."
        ],
        "nombre": [
            "El campo nombre es obligatorio."
        ],
        "ap_paterno": [
            "El campo ap_paterno es obligatorio."
        ],
        "ap_materno": [
            "El campo ap_materno es obligatorio."
        ],
        "ap_esposo": [
            "El campo ap_esposo es obligatorio."
        ],
        "sexo": [
            "El campo sexo es obligatorio."
        ],
        "municipio_id_nacimiento": [
            "El campo municipio_id_nacimiento es obligatorio."
        ],
        "fecha_nacimiento": [
            "El campo fecha_nacimiento id es obligatorio."
        ],
        "estado_civil": [
            "El campo estado_civil at es obligatorio."
        ],
        "nacionalidad": [
            "El campo nacionalidad es obligatorio."
        ],
        "profesion_ocupacion": [
            "El campo profesion_ocupacion es obligatorio."
        ],
        "relacion_victima_id": [
            "El campo relacion_victima_id id es obligatorio."
        ],
        "idioma_id": [
            "El campo idioma_id es obligatorio."
        ],
        "autoidentificacion_id": [
            "El campo autoidentificacion_id es obligatorio."
        ],
        "nivel_educacion_id": [
            "El campo nivel_educacion_id es obligatorio."
        ],
        "domicilio": [
            "El campo user id es obligatorio."
        ],
        "user_id": [
            "El campo domicilio es obligatorio."
        ],
        "telefono": [
            "El campo telefono es obligatorio."
        ],
        "celular": [
            "El campo celular es obligatorio."
        ],
        "email": [
            "El campo email es obligatorio."
        ],
        "lugar_trabajo": [
            "El campo lugar_trabajo es obligatorio."
        ],
        "domicilio_laboral": [
            "El campo domicilio_laboral es obligatorio."
        ],
        "telf_laboral": [
            "El campo telf_laboral es obligatorio."
        ],
    },
    "code": 422
}
```

### HTTP Request
`POST api/v2/casos/{hecho}/sujetosProcesales?tipo={sujetoProcesal}&es_persona={natural, juridica}`


<!-- END_a71dcd3d6f16c5c1b0e42b270fa7547d -->

<!-- START_1329e26090257571a555acedc5bc305a -->
## Método PUT para Actualizar los datos de un Sujeto Procesal.

En este metodo aceptamos 2 tipos de parametros extra que son el <b>Tipo de sujeto Procesal</b> y el <b>n_documento</b>
<b>tipo=1 (Persona Denunciante)</b><br>
<b>tipo=2 (Persona Denunciado)</b><br>
<b>tipo=3 (Persona Victima)</b><br>
<b>tipo=4 (Persona Testigo)</b><br>
<b>n_documento= 7864815 (Carnet de Identida, Pasaporte, etc)</b><br>
<b>esta_procesal= 1 (detenido, aprendido)</b><br>

> Example request:

```bash
curl -X PUT "http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/sujetosProcesales?tipo=1&n_documento=2" \
    -H "Authorization: Bearer " \
    -H "Api-Version: v2"
```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/sujetosProcesales?tipo=1&n_documento=2");

let headers = {
    "Authorization": "Bearer ",
    "Api-Version": "v2",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```

> Example response (201):

```json
{
    "error": {"los campos fueron actualizados Correctamente"},
    "code": 201
}
```

### HTTP Request
`PUT api/v2/casos/{hecho}/sujetosProcesales?tipo={suejto_procesal}&n_documento={ci, pasaporte, etc}`

`PATCH api/v2/casos/{hecho}/sujetosProcesales?tipo={suejto_procesal}&n_documento={ci, pasaporte, etc}`


<!-- END_1329e26090257571a555acedc5bc305a -->

#Metodos para el F.U.D.


<!-- START_a6c2bd4ae9bf91e1a036bdc87b71610e -->
## Metodo Get Genera un listado de todos los Casos existentes

puede generar un listado de todos los casos existentes paginados cada 5 casos
como se puede observar en el ejemplo

> Example request:

```bash
curl -X GET -G "http://api-dev.fiscalia.gob.bo/api/v2/casos" \
    -H "Authorization: Bearer " \
    -H "Api-Version: v2"
```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/casos");

let headers = {
    "Authorization": "Bearer ",
    "Api-Version": "v2",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "página_actual": 1,
    "datos": [
        {
            "codigo": "634999",
            "relato": "Et error tempore molestiae temporibus corrupti quis animi voluptatem autem et rerum.",
            "conducta": "Maxime autem.",
            "resultado": "Omnis nemo velit nostrum facilis laborum.",
            "circunstancia": "Minima deserunt est omnis nostrum nihil repellendus fuga laborum pariatur mollitia ipsam aut enim.",
            "direccion": "8627 McLaughlin Heights\nNew Rainatown, WY 36166",
            "zona": "51322 Bins Skyway Apt. 269\nMylesmouth, MN 69265-2440",
            "detallelocacion": "Recusandae debitis dignissimos rerum.",
            "municipio_id": 49,
            "created_at": "2019-08-05 18:38:01",
            "longitude": "-66.771585",
            "latitude": "-14.090757",
            "tipo_denuncia_id": 4,
            "fechahorainicio": "2010-01-09 01:42:00",
            "fechahorafin": "1981-08-31 18:49:23",
            "aproximado": "Fuga quia earum sit veritatis.",
            "oficina_id": null,
            "titulo": null
        },
        {
            "codigo": "220518",
            "relato": "Consequatur facere nulla repellat consectetur non temporibus molestiae eos odit corrupti aut et sint fuga vel nobis commodi.",
            "conducta": "Exercitationem possimus non labore est.",
            "resultado": "Dolorum rerum ipsum quidem molestiae.",
            "circunstancia": "Impedit cum modi et doloremque nesciunt quidem delectus laudantium consectetur.",
            "direccion": "864 Lockman Cliff\nNew Isidro, NC 71615",
            "zona": "36683 Mitchell Corner\nRoweshire, NH 82887",
            "detallelocacion": "Laudantium dolorem id ducimus debitis totam expedita.",
            "municipio_id": 4,
            "created_at": "2019-08-05 18:38:01",
            "longitude": "-65.385023",
            "latitude": "-14.431075",
            "tipo_denuncia_id": 3,
            "fechahorainicio": "1986-02-05 05:54:39",
            "fechahorafin": "1991-01-23 00:37:21",
            "aproximado": "Amet sint similique reiciendis.",
            "oficina_id": null,
            "titulo": null
        },
        {
            "codigo": "608431",
            "relato": "Aut non voluptates molestiae aut omnis voluptatum quam placeat et exercitationem dolor non deleniti neque voluptatem incidunt.",
            "conducta": "Mollitia officia impedit nihil.",
            "resultado": "Earum consequatur deleniti animi voluptatibus molestias.",
            "circunstancia": "Eius necessitatibus nesciunt cum eum ratione ut et accusantium veniam.",
            "direccion": "5789 Hettinger Walk\nPort Isabel, AK 63330",
            "zona": "962 Verdie Track\nRatkeport, IN 86319-1927",
            "detallelocacion": "Veritatis adipisci possimus ex incidunt ut.",
            "municipio_id": 53,
            "created_at": "2019-08-05 18:38:01",
            "longitude": "-65.429668",
            "latitude": "-14.215086",
            "tipo_denuncia_id": 5,
            "fechahorainicio": "1975-02-08 00:02:47",
            "fechahorafin": "1990-11-25 10:51:44",
            "aproximado": "Molestiae qui impedit sapiente.",
            "oficina_id": null,
            "titulo": null
        },
        {
            "codigo": "463870",
            "relato": "Iusto et quisquam possimus voluptatibus dolorem eum aperiam alias quis ea iure corrupti vel corrupti vel facilis illo nostrum accusantium et.",
            "conducta": "Nesciunt consectetur aut reprehenderit.",
            "resultado": "Consequatur est atque assumenda.",
            "circunstancia": "Aperiam nisi enim aliquam totam aperiam quam magnam vel aut nostrum veritatis.",
            "direccion": "90061 Ara Extension\nTillmanmouth, ID 57483",
            "zona": "14319 Roberts Mission\nMuellerton, OR 12139-1405",
            "detallelocacion": "Labore alias et consequatur autem vero.",
            "municipio_id": 8,
            "created_at": "2019-08-05 18:38:01",
            "longitude": "-65.703666",
            "latitude": "-13.834202",
            "tipo_denuncia_id": 2,
            "fechahorainicio": "1987-01-14 16:09:56",
            "fechahorafin": "2006-07-10 23:27:32",
            "aproximado": "Maxime incidunt sunt maxime.",
            "oficina_id": null,
            "titulo": null
        },
        {
            "codigo": "603390",
            "relato": "Vel officiis laboriosam est voluptatem sed dicta officiis laborum ad alias et ut dolores dolor.",
            "conducta": "Dicta et deserunt odio.",
            "resultado": "Eum consequatur officia earum molestias aut quaerat sunt.",
            "circunstancia": "Ut non eum odit nobis qui deserunt minus animi.",
            "direccion": "88397 Estrella Valleys\nEast Jermeyhaven, VA 71078",
            "zona": "703 Citlalli Hill\nStromanhaven, WI 61809",
            "detallelocacion": "Vel nihil accusantium occaecati a.",
            "municipio_id": 75,
            "created_at": "2019-08-05 18:38:02",
            "longitude": "-66.479394",
            "latitude": "-13.920695",
            "tipo_denuncia_id": 5,
            "fechahorainicio": "1982-10-21 04:02:49",
            "fechahorafin": "2014-10-05 18:34:59",
            "aproximado": "Aut praesentium corporis quia.",
            "oficina_id": null,
            "titulo": null
        }
    ],
    "url_primera_pagina": "http://api-dev.fiscalia.gob.bo/api/v2/casos?page=1",
    "desde": 1,
    "ultima_pagina": 23,
    "url_ultima_pagina": "http://api-dev.fiscalia.gob.bo/api/v2/casos?page=23",
    "url_pagina_siguiente": "http://api-dev.fiscalia.gob.bo/api/v2/casos?page=2",
    "path": "http://api-dev.fiscalia.gob.bo/api/v2/casos",
    "por_pagina": 5,
    "purl_pagina_anterior": null,
    "a": 5,
    "total": 115
}
```

### HTTP Request
`GET api/v2/casos`


<!-- END_a6c2bd4ae9bf91e1a036bdc87b71610e -->

<!-- START_376ad92579502087eb0ae4e5b69c45b1 -->
## Metodo POST Insertar un nuevo Caso.

en este metodo podemos insertar todo los campos referentes al sujeto procesal<br><br>
 <p><b>CAMPOS DE INSERCION EN EL POST</b></p>
 <b>'codigo' => 'required|string'</b><br>
 <b>'relato' => 'required|string'</b><br>
 <b>'conducta'=> 'required|string'</b><br>
 <b>'resultado' => 'required|string'</b><br>
 <b>'circunstancia' => 'required|string'</b><br>
 <b>'direccion' => 'required|string'</b><br>
 <b>'zona' => 'required|string'</b><br>
 <b>'detallelocacion' => 'required|string'</b><br>
 <b>'municipio_id' => 'required|numeric'</b><br>
 <b>'created_at' => 'required|date'</b><br>
 <b>'longitude' => 'required|numeric'</b><br>
 <b>'latitude' => 'required|numeric'</b><br>
 <b>'tipo_denuncia_id' => 'required|numeric'</b><br>
 <b>fechahorainicio' => 'required|date'</b><br>
 <b>'fechahorafin' => 'required|date'</b><br>
 <b>'aproximado' => 'string'</b><br>
 <b>'oficina_id' => 'required|numeric'</b><br>
 <b>'titulo' => 'max:250'</b><br>
 <b>'user_id' => 'required|numeric'</b><br>

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/casos" \
    -H "Authorization: Bearer " \
    -H "Api-Version: v2"
```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/casos");

let headers = {
    "Authorization": "Bearer ",
    "Api-Version": "v2",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "error": {
        "codigo": [
            "El campo codigo es obligatorio."
        ],
        "relato": [
            "El campo relato es obligatorio."
        ],
        "conducta": [
            "El campo conducta es obligatorio."
        ],
        "resultado": [
            "El campo resultado es obligatorio."
        ],
        "circunstancia": [
            "El campo circunstancia es obligatorio."
        ],
        "direccion": [
            "El campo direccion es obligatorio."
        ],
        "zona": [
            "El campo zona es obligatorio."
        ],
        "detallelocacion": [
            "El campo detallelocacion es obligatorio."
        ],
        "municipio_id": [
            "El campo municipio id es obligatorio."
        ],
        "created_at": [
            "El campo created at es obligatorio."
        ],
        "longitude": [
            "El campo longitude es obligatorio."
        ],
        "latitude": [
            "El campo latitude es obligatorio."
        ],
        "tipo_denuncia_id": [
            "El campo tipo denuncia id es obligatorio."
        ],
        "fechahorainicio": [
            "El campo fechahorainicio es obligatorio."
        ],
        "fechahorafin": [
            "El campo fechahorafin es obligatorio."
        ],
        "oficina_id": [
            "El campo oficina id es obligatorio."
        ],
        "user_id": [
            "El campo user id es obligatorio."
        ]
    },
    "code": 422
}
```

### HTTP Request
`POST api/v2/casos`


<!-- END_376ad92579502087eb0ae4e5b69c45b1 -->

<!-- START_7b09fc50ea4b0d5b390ef08a4febc61c -->
## Metodo GET para obtener un solo caso; se envia el codigo del caso en la URL.

<p><b>CASO DE EJEMPLO</b></p>
<b>/v2/casos/324727</b>

> Example request:

```bash
curl -X GET -G "http://api-dev.fiscalia.gob.bo/api/v2/casos/324727" \
    -H "Authorization: Bearer " \
    -H "Api-Version: v2"
```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/casos/324727");

let headers = {
    "Authorization": "Bearer ",
    "Api-Version": "v2",
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (500):

```json
{
    "codigo": "324727",
    "relato": "12345678",
    "conducta": "12345678",
    "resultado": "Ut perspiciatis voluptatibus dolorem sit dolores nihil voluptatem.",
    "circunstancia": "Consequatur et consequatur vel recusandae et est rerum temporibus nesciunt.",
    "direccion": "797 Mante Islands\nEast Jedidiah, NV 49284-2587",
    "zona": "1246 Kari Summit\nKatherineburgh, WI 52582",
    "detallelocacion": "Dolores et id sunt minima deserunt voluptatem.",
    "municipio_id": 32,
    "created_at": "2019-08-05 18:38:01",
    "longitude": "-64.933732",
    "latitude": "-14.309941",
    "tipo_denuncia_id": 2,
    "fechahorainicio": "2008-03-02 03:14:48",
    "fechahorafin": "2005-05-20 09:52:27",
    "aproximado": "Enim culpa itaque dignissimos.",
    "titulo": null
}
```

### HTTP Request
`GET api/v2/casos/{codigo_FUD}`


<!-- END_7b09fc50ea4b0d5b390ef08a4febc61c -->