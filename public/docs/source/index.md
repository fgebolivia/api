---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://api-dev.fiscalia.gob.bo/docs/collection.json)

<!-- END_INFO -->

#Estado Servicio


<!-- START_7b8abd27573a846ef5c67ec0d43c6529 -->
## Estado - Estado de la API REST.

> Example request:

```bash
curl -X GET -G "http://api-dev.fiscalia.gob.bo/api/v2/connection" \
    -H "Authorization: Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}"
```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/connection");

let headers = {
    "Authorization": "Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}",
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
    "message": "El servicio de Ministerio Publico v2 se encuentra disponible",
    "code": 200
}
```

### HTTP Request
`GET api/v2/connection`


<!-- END_7b8abd27573a846ef5c67ec0d43c6529 -->

#Metodo REJAF


<!-- START_bfc712ac3415f38be395c887c62a1478 -->
## Insercion con metodo POST de Certificaciones REJAF.

Este Metodo esta en espera de la respuesta de una solicitud anterior echa para obtener el REJAF<br><br>

 <p><b>CAMPOS DE INSERCION EN EL POST</b></p>

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/rejaf" \
    -H "Authorization: Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}" \
    -H "Content-Type: application/json" \
    -d '{"n_documento":"quaerat","complemento":"qui","nombre":"sint","ap_paterno":"et","ap_materno":"vel","fecha_nacimiento":"est","solicitud":"iste","wed_id":"nostrum","fecha_envio":"ut","observacion":"voluptate","estado":"suscipit","certificado":"a"}'

```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/rejaf");

let headers = {
    "Authorization": "Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "n_documento": "quaerat",
    "complemento": "qui",
    "nombre": "sint",
    "ap_paterno": "et",
    "ap_materno": "vel",
    "fecha_nacimiento": "est",
    "solicitud": "iste",
    "wed_id": "nostrum",
    "fecha_envio": "ut",
    "observacion": "voluptate",
    "estado": "suscipit",
    "certificado": "a"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "El rejaf se Inserto satisfactoriamente",
    "code": 201
}
```

### HTTP Request
`POST api/v2/rejaf`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    n_documento | string |  required  | el carnet de identidad para validacion
    complemento | string |  required  | el para la validacion
    nombre | string |  required  | el nombre para la validacion
    ap_paterno | string |  required  | el apellido paterno para la validacion
    ap_materno | string |  required  | el apellido materno para la validacion
    fecha_nacimiento | date |  required  | la fecha de nacimiento para la validacion
    solicitud | string |  required  | codigo de la solicitud
    wed_id | string |  required  | codigo web id del certificado REJAF
    fecha_envio | date |  required  | Fecha en la que se envio el Certificado REJAF
    observacion | string |  required  | alguna observacion del Certificado REJAF
    estado | string |  required  | estado del Certificado REJAF
    certificado | BASE_64 |  required  | DOCUMENTO PDF del REJAF

<!-- END_bfc712ac3415f38be395c887c62a1478 -->

#Metodo para Notificaciones.


<!-- START_6f7a48a3daea6fd0cecb080b510107ee -->
## Metodo POST de Notificaciones

Este metodo se podran recibir varias notificaciones de las diferentes instituciones
 <p><b>CAMPOS DE INSERCION EN EL POST</b></p>

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/notificaciones" \
    -H "Authorization: Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}" \
    -H "Content-Type: application/json" \
    -d '{"codigo_FUD":"enim","codigo_tipo_notificacion":"quod","fecha_hora_notificacion":"ut","sujeto":"est","notificador":"quia","solicitante":"eos","actuado_actividad":"facilis","archivo":"non"}'

```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/notificaciones");

let headers = {
    "Authorization": "Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "codigo_FUD": "enim",
    "codigo_tipo_notificacion": "quod",
    "fecha_hora_notificacion": "ut",
    "sujeto": "est",
    "notificador": "quia",
    "solicitante": "eos",
    "actuado_actividad": "facilis",
    "archivo": "non"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "La Notificaion se Inserto satisfactoriamente",
    "code": 201
}
```

### HTTP Request
`POST api/v2/notificaciones`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    codigo_FUD | string |  required  | codigo unico de la denuncia
    codigo_tipo_notificacion | string |  required  | Código del tipo de actividad / actuado realizado hacia la Fiscalia
    fecha_hora_notificacion | date |  required  | Fecha en la que se realiza la Actividad/Actuado
    sujeto | array[] |  required  | Datos para la verificacionde una persona nombre apellidos fecha nacimiento
    notificador | array[] |  required  | Datos para la verificacionde una persona nombre apellidos fecha nacimiento
    solicitante | array[] |  required  | Datos para la verificacionde una persona nombre apellidos fecha nacimiento
    actuado_actividad | string |  required  | descripcion del actuado o Actividad
    archivo | BASE64 |  required  | archivo del actuado a activdad en formato PDF convertido en BASE64 maximo 10MB

<!-- END_6f7a48a3daea6fd0cecb080b510107ee -->

#Metodos Actividades.


<!-- START_91379747937eb85a9fdf28770fb9c71b -->
## Metodo POST de Notificaciones

Este metodo se podran recibir varias notificaciones de las diferentes instituciones
 <p><b>CAMPOS DE INSERCION EN EL POST</b></p>

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/actividad" \
    -H "Authorization: Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}" \
    -H "Content-Type: application/json" \
    -d '{"codigo_fud":"amet","codigo_actividad":5,"codigo_tipo_actividad":4,"fecha_actividad":"atque","descripcion_actividad":"distinctio","archivo_actividad":"nam"}'

```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/actividad");

let headers = {
    "Authorization": "Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "codigo_fud": "amet",
    "codigo_actividad": 5,
    "codigo_tipo_actividad": 4,
    "fecha_actividad": "atque",
    "descripcion_actividad": "distinctio",
    "archivo_actividad": "nam"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "La Actividad se Inserto satisfactoriamente",
    "code": 201
}
```

### HTTP Request
`POST api/v2/actividad`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    codigo_fud | string |  required  | Codigo unido del Caso
    codigo_actividad | integer |  required  | Código único de la Actividad
    codigo_tipo_actividad | integer |  required  | Código del catálogo de tipo de actividad
    fecha_actividad | date |  required  | Fecha de Emisión de la Actividad
    descripcion_actividad | string |  required  | Pequeña descripción de la actividad
    archivo_actividad | BASE64 |  required  | Archivo relacionado con la Actividad en formato PDF (base64)

<!-- END_91379747937eb85a9fdf28770fb9c71b -->

#Metodos Medidas de Proteccion.


<!-- START_4934cf910dfdb8173665030b54a3ba9b -->
## Registro POST de Medidas de Proteccion.

Este metodo es para registrar las Medidas de Proteccion de una Victima <br><br>
 en la Url se debe colocar el ci de la persona como el numero de caso <br>
 Url base acompañado del ?ci= numero de carnet<br>

<p><b>CAMPOS DE INSERCION EN EL POST-PERSONA NATURAL O DESCONOCIDA</b></p>

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/medidas" \
    -H "Authorization: Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}" \
    -H "Content-Type: application/json" \
    -d '{"codigo_medida_proteccion":14,"tipo":7,"inciso":7}'

```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/medidas");

let headers = {
    "Authorization": "Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "codigo_medida_proteccion": 14,
    "tipo": 7,
    "inciso": 7
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "las Medidas se llenaron Correctamente",
    "code": 201
}
```

### HTTP Request
`POST api/v2/casos/{hecho}/medidas`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    codigo_medida_proteccion | integer |  required  | Código asignado de un catálogo definido por la ley 1173
    tipo | integer |  required  | Tipo de medida (tipo 1 para medidas de la víctima niño o niña.
    inciso | integer |  required  | Inciso donde se encuentra la descrita la medida de protección de la ley 1173

<!-- END_4934cf910dfdb8173665030b54a3ba9b -->

<!-- START_1e9751c498972821c495b54cfc086a4b -->
## Actualizacion PUT de Medidas de Proteccion.

Este metodo es para registrar las Medidas de Proteccion de una Victima <br><br>
 en la Url se debe colocar el ci de la persona como el numero de caso <br>
 Url base acompañado del ?ci= numero de carnet<br>

<p><b>CAMPOS DE INSERCION EN EL POST-PERSONA NATURAL O DESCONOCIDA</b></p>

> Example request:

```bash
curl -X PUT "http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/medidas/1" \
    -H "Authorization: Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}" \
    -H "Content-Type: application/json" \
    -d '{"codigo_medida_proteccion":4,"tipo":19,"inciso":14}'

```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/casos/324727/medidas/1");

let headers = {
    "Authorization": "Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "codigo_medida_proteccion": 4,
    "tipo": 19,
    "inciso": 14
}

fetch(url, {
    method: "PUT",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "las Medidas se Actualizaron Correctamente",
    "code": 201
}
```

### HTTP Request
`PUT api/v2/casos/{hecho}/medidas/{medida}`

`PATCH api/v2/casos/{hecho}/medidas/{medida}`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    codigo_medida_proteccion | integer |  required  | Código asignado de un catálogo definido por la ley 1173
    tipo | integer |  required  | Tipo de medida (tipo 1 para medidas de la víctima niño o niña.
    inciso | integer |  required  | Inciso donde se encuentra la descrita la medida de protección de la ley 1173

<!-- END_1e9751c498972821c495b54cfc086a4b -->

#Metodos Sujetos Procesales


<!-- START_342fa55c54b09c080ad50d7f3c9abaf6 -->
## Metodo POST para registro de Sujetos Procesales.

En este metodo debe mandarse la informacion Generada en las Instituciones con acceso a esta API
cade vez que se genere un nuevo tipo de Sujeto Procesal se de ma andar 2 parametros adicionales
como ser el <b>tipo=</b> y el <b>es_persona=</b> donde los parametros van de acuerdo a lo sgt<br>
<b>tipo=1 (Persona Denunciante)  |</b> <b>es_persona=0 (Persona Juridica)</b><br>
<b>tipo=2  (Persona Denunciado)  |</b> <b>es_persona=1 (Persona natural)</b><br>
<b>tipo=3    (Persona Victima)   |</b> <b>es_persona=2 (Persona Desconocida y/o Extranjera)</b><br>
<b>tipo=4    (Persona Testigo)   |</b><br>
<p><b>CAMPOS DE INSERCION EN EL POST-PERSONA NATURAL O DESCONOCIDA</b></p>

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/casos/601102011900007/sujetosprocesales?tipo=1&es_persona=1" \
    -H "Authorization: Bearer " \
    -H "Api-Version: v2" \
    -H "Content-Type: application/json" \
    -d '{"es_victima":16,"es_persona_valida":18,"codigo_municipio_residencia":"non","n_documento":"non","nombre":"neque","ap_paterno":"adipisci","ap_materno":"excepturi","ap_esposo":"est","sexo":"exercitationem","fecha_nacimiento":"suscipit","estado_civil":"est","domicilio":"a","telefono":"quo","celular":"velit","profesion_ocupacion":"unde","pueblo_originario":"eligendi","lugar_trabajo":"tempore","domicilio_laboral":"quas","telefono_laboral":"non","alias":"et","estatura":false,"tez":"qui","edad":"quam","vestimenta":"aut","senia":"reprehenderit","peso":"enim","cabello":"fugit","genero":"sunt","email":"ex","ojos":true,"ciudadano_digital":"quae","relacion_victima":19,"nivel_educacion":16,"grupo_vulnerable":11,"grado_discapacidad":4,"estado_procesal":1,"fecha_estado_procesal":"molestiae","nit":2,"razon_social":"voluptatibus","map_latitud":"quia","map_longitud":"aut","relacion_victima_id":8,"estado_procesal_id":17,"n_documento_representante_legal":"et","Nombre_representante_legal":"quod","ap_paterno_representante_legal":"ullam","ap_materno_representante_legal":"saepe","fecha_nacimiento_representante_legal":"quas"}'

```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/casos/601102011900007/sujetosprocesales?tipo=1&es_persona=1");

let headers = {
    "Authorization": "Bearer ",
    "Api-Version": "v2",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "es_victima": 16,
    "es_persona_valida": 18,
    "codigo_municipio_residencia": "non",
    "n_documento": "non",
    "nombre": "neque",
    "ap_paterno": "adipisci",
    "ap_materno": "excepturi",
    "ap_esposo": "est",
    "sexo": "exercitationem",
    "fecha_nacimiento": "suscipit",
    "estado_civil": "est",
    "domicilio": "a",
    "telefono": "quo",
    "celular": "velit",
    "profesion_ocupacion": "unde",
    "pueblo_originario": "eligendi",
    "lugar_trabajo": "tempore",
    "domicilio_laboral": "quas",
    "telefono_laboral": "non",
    "alias": "et",
    "estatura": false,
    "tez": "qui",
    "edad": "quam",
    "vestimenta": "aut",
    "senia": "reprehenderit",
    "peso": "enim",
    "cabello": "fugit",
    "genero": "sunt",
    "email": "ex",
    "ojos": true,
    "ciudadano_digital": "quae",
    "relacion_victima": 19,
    "nivel_educacion": 16,
    "grupo_vulnerable": 11,
    "grado_discapacidad": 4,
    "estado_procesal": 1,
    "fecha_estado_procesal": "molestiae",
    "nit": 2,
    "razon_social": "voluptatibus",
    "map_latitud": "quia",
    "map_longitud": "aut",
    "relacion_victima_id": 8,
    "estado_procesal_id": 17,
    "n_documento_representante_legal": "et",
    "Nombre_representante_legal": "quod",
    "ap_paterno_representante_legal": "ullam",
    "ap_materno_representante_legal": "saepe",
    "fecha_nacimiento_representante_legal": "quas"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "datos llenados correctamente en el caso xxxxxx",
    "code": 201
}
```

### HTTP Request
`POST api/v2/casos/{hecho}/sujetosprocesales`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    es_victima | integer |  optional  | opcional Tipo booleano  devuelve 0: si no es víctima o 1: si es víctima
    es_persona_valida | integer |  required  | persona_Natural=1, Jurídica=1 o Desconocida=0
    codigo_municipio_residencia | string |  required  | Municipio de residencia de una persona
    n_documento | string |  required  | Carnet de identidad de la una persona válida por el SEGIF
    nombre | string |  required  | Nombre de la persona natural
    ap_paterno | string |  required  | Apellido paterno de la persona natural
    ap_materno | string |  required  | Apellido materno de la persona natural
    ap_esposo | string |  required  | Apellido esposo de la persona natural
    sexo | date |  optional  | opcional Sexo de la persona natural
    fecha_nacimiento | date |  required  | Fecha de nacimiento de la persona natural (Ejemplo 2019-10-24 15:30:15)
    estado_civil | numeric |  optional  | opcional Estado civil de la persona natural
    domicilio | string |  optional  | opcional Domicilio de la empresa
    telefono | string |  optional  | opcional Teléfono de la empresa
    celular | string |  optional  | opcional Celular de la persona natural
    profesion_ocupacion | string |  optional  | opcional Profesión de la persona natural
    pueblo_originario | string |  optional  | opcional Pueblo originario del que se considera la persona natural
    lugar_trabajo | string |  optional  | opcional Lugar de trabajo de la persona natural
    domicilio_laboral | date |  optional  | opcional Domicilio de donde trabaja la persona natural
    telefono_laboral | string |  optional  | opcional Teléfono del lugar donde trabaja la persona natural
    alias | numeric |  optional  | opcional Alias de la persona natural
    estatura | boolean |  optional  | opcional Estatura de la persona natural
    tez | numeric |  optional  | opcional Tes de la persona natural
    edad | string |  optional  | opcional Edad de la persona natural
    vestimenta | string |  optional  | opcional Vestimenta de la persona natural
    senia | string |  optional  | Señas particulares de la persona natural
    peso | string |  optional  | opcional Peso de la persona natural
    cabello | date |  optional  | opcional Cabello de la persona natural
    genero | string |  optional  | opcional Género de la persona natural
    email | numeric |  optional  | opcional Email de la persona natural
    ojos | boolean |  optional  | opcional Color de ojos de la persona natural
    ciudadano_digital | numeric |  required  | Tipo booleano  devuelve 0: si no es ciudadano Digital o 1: si es ciudadano digital
    relacion_victima | integer |  optional  | opcional id del catálogo de relación con la víctim
    nivel_educacion | integer |  optional  | opcional id del catálogo del grado de educación recibida
    grupo_vulnerable | integer |  optional  | opcional id del catálogo  grupo vulnerable
    grado_discapacidad | integer |  optional  | opcional id del catálogo grado de discapacidad
    estado_procesal | integer |  optional  | opcional id del estado procesal en el que se encuentra actualmente
    fecha_estado_procesal | date |  optional  | opcional fecha en la que  se llevo acabo el estado procesal en el que se encuentra actualment
    nit | integer |  required  | Número de Identificación Tributaria de la persona jurídica
    razon_social | string |  required  | Nombre de la Empresa
    map_latitud | string |  required  | Latitud de la ubicación de la empresa
    map_longitud | string |  required  | Longitud de la ubicación de la empresa
    relacion_victima_id | integer |  optional  | opcional Código del catálogo de relación de la víctima
    estado_procesal_id | integer |  optional  | Código del estado Procesal en el que se encuentra
    n_documento_representante_legal | string |  required  | Ci del representante legal de la persona jurídica para validacion
    Nombre_representante_legal | string |  required  | Nombre del representante legal de la persona jurídica para validación
    ap_paterno_representante_legal | string |  required  | Apellido Paterno del representante legal de la persona jurídica para validación
    ap_materno_representante_legal | string |  required  | Apellido Materno del representante legal de la persona jurídica para validación
    fecha_nacimiento_representante_legal | date |  required  | Fecha de nacimiento de la persona natural (Ejemplo 2019-10-24 15:30:15)

<!-- END_342fa55c54b09c080ad50d7f3c9abaf6 -->
<!-- START_01691b0909c874275500685f20cc919e -->
## Metodo PUT para Actualizar los datos de un Sujeto Procesal.

este metodo aceptamos 2 tipos de parametros extra que son el <b>Tipo de sujeto Procesal</b> y el <b>n_documento</b>
<b>tipo=1 (Persona Denunciante)</b><br>
<b>tipo=2 (Persona Denunciado)</b><br>
<b>tipo=3 (Persona Victima)</b><br>
<b>tipo=4 (Persona Testigo)</b><br>
<b>es_persona=0 (Persona Juridica)</b><br>
<b>es_persona=1 (Persona natural)</b><br>
<b>es_persona=2 (Persona Desconocida y/o Extranjera)</b><br>

> Example request:

```bash
curl -X PUT "http://api-dev.fiscalia.gob.bo/api/v2/casos/601102011900007/sujetosprocesales?tipo=1&es_persona=1" \
    -H "Authorization: Bearer " \
    -H "Api-Version: v2"
```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/casos/601102011900007/sujetosprocesales?tipo=1&es_persona=1");

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


> Example response (200):

```json
{
    "message": "datos Actualizados correctamente en el caso xxxxxx",
    "code": 201
}
```

### HTTP Request
`PUT api/v2/casos/{hecho}/sujetosprocesales/{sujetosprocesale}`

`PATCH api/v2/casos/{hecho}/sujetosprocesales/{sujetosprocesale}`


<!-- END_01691b0909c874275500685f20cc919e -->
#Metodos de Arpobacionde Documentos AGETIC.


<!-- START_3121208c276e4ec50c2414f61df4fa8d -->
## Store a newly created resource in storage.

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/aprobaciondocumentos" \
    -H "Authorization: Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}"
```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/aprobaciondocumentos");

let headers = {
    "Authorization": "Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}",
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
    "error": "Unexpected error",
    "code": 500
}
```

### HTTP Request
`POST api/v2/aprobaciondocumentos`


<!-- END_3121208c276e4ec50c2414f61df4fa8d -->

#Metodos de reparto de Juez Juzgado de un Caso.


<!-- START_c0912a61f12aec98e23dcfff958fe2e4 -->
## Metodo POST registro del reparto de un Juez y Jusgado de un caso.

en este metodo podemos insertar todo los campos referentes al Juez y el reparto<br><br>
 <p><b>CAMPOS DE INSERCION EN EL POST</b></p>

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/agendamiento/13/juez" \
    -H "Authorization: Bearer " \
    -H "Api-Version: v2" \
    -H "Content-Type: application/json" \
    -d '{"codigo_juzgado":8,"codigo_fud":"autem","n_documento":"rerum","complemento":"repellendus","nombre":"architecto","ap_paterno":"est","ap_materno":"voluptates","fecha_nacimiento":"quam"}'

```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/agendamiento/13/juez");

let headers = {
    "Authorization": "Bearer ",
    "Api-Version": "v2",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "codigo_juzgado": 8,
    "codigo_fud": "autem",
    "n_documento": "rerum",
    "complemento": "repellendus",
    "nombre": "architecto",
    "ap_paterno": "est",
    "ap_materno": "voluptates",
    "fecha_nacimiento": "quam"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "El Juez se Inserto satisfactoriamente",
    "code": 201
}
```

### HTTP Request
`POST api/v2/agendamiento/{codigo}/juez`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    codigo_juzgado | integer |  required  | el carnet de identidad para validacion
    codigo_fud | string |  required  | el para la validacion
    n_documento | string |  required  | el carnet de identidad para validacion
    complemento | string |  optional  | opcional el para la validacion
    nombre | string |  required  | el nombre para la validacion
    ap_paterno | string |  required  | el apellido paterno para la validacion
    ap_materno | string |  required  | el apellido materno para la validacion
    fecha_nacimiento | date |  required  | la fecha de nacimiento para la validacion

<!-- END_c0912a61f12aec98e23dcfff958fe2e4 -->
#Metodos para el Agendamiento de Audiencias.


<!-- START_6d4a13f77eedf4d280f19490a6244ba6 -->
## Metodo POST para la insercion del Agendamiento de las Audiencias.

en este metodo podemos insertar todo los campos referentes al sujeto procesal<br><br>
 <p><b>CAMPOS DE INSERCION EN EL POST</b></p>

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/agendamiento" \
    -H "Authorization: Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}" \
    -H "Content-Type: application/json" \
    -d '{"codigo_fud":"quia","codigo_agendamiento":14,"fecha_hora_inicio":"ipsum","fecha_hora_fin":"consectetur","codigo_tipo_audiencia":20,"sala":"molestiae","codigo_juzgado":"recusandae","archivo_pdf":"recusandae"}'

```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/agendamiento");

let headers = {
    "Authorization": "Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "codigo_fud": "quia",
    "codigo_agendamiento": 14,
    "fecha_hora_inicio": "ipsum",
    "fecha_hora_fin": "consectetur",
    "codigo_tipo_audiencia": 20,
    "sala": "molestiae",
    "codigo_juzgado": "recusandae",
    "archivo_pdf": "recusandae"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "El Agendamiento se Inserto satisfactoriamente",
    "code": 201
}
```

### HTTP Request
`POST api/v2/agendamiento`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    codigo_fud | string |  required  | Código Único de la Denuncia
    codigo_agendamiento | integer |  required  | Código único del Agendamiento
    fecha_hora_inicio | date |  required  | Fecha y hora de inicio de audiencia (aaaa-MM-dd hh:mm) (2019-10-03 17:00)
    fecha_hora_fin | date |  required  | Fecha y hora fin de audiencia (aaaa-MM-dd hh:mm) (2019-10-03 19:00)
    codigo_tipo_audiencia | integer |  optional  | Catálogo de Tipos de Audiencias
    sala | string |  required  | Denominativo de la sala donde se llevara a cabo la Audiencia
    codigo_juzgado | string |  required  | Juzgado id del catálogo de juzgados
    archivo_pdf | BASE_64 |  required  | Documento tipo PDF en base 64 referente a la audiencia

<!-- END_6d4a13f77eedf4d280f19490a6244ba6 -->

<!-- START_96a9f55b1b7a6f5618565174cdc5dc85 -->
## Metodo POST para Informar de una la suspencionde Una Agendamiento de Audiencia

En este campo la oficina gestora podra dar informanos las causas de por que se dio de baja una Audiencia<br><br>
 <p><b>CAMPOS DE INSERCION EN EL POST</b></p>

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/agendamiento/suspencion" \
    -H "Authorization: Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}" \
    -H "Content-Type: application/json" \
    -d '{"codigo_agendamiento":20,"codigo_tipo_causal":5,"descripcion":"soluta","archivo_baja_audiencia":"repellat"}'

```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/agendamiento/suspencion");

let headers = {
    "Authorization": "Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "codigo_agendamiento": 20,
    "codigo_tipo_causal": 5,
    "descripcion": "soluta",
    "archivo_baja_audiencia": "repellat"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "Se dio de baja el agendamiento satisfactoriamente",
    "code": 201
}
```

### HTTP Request
`POST api/v2/agendamiento/suspencion`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    codigo_agendamiento | integer |  required  | Código único del Agendamiento
    codigo_tipo_causal | integer |  required  | Catalogo de Causales de Suspencion
    descripcion | string |  optional  | opcional Descripcion de la causal de suspencion
    archivo_baja_audiencia | Base64 |  required  | Documento en BASE64 de la causal de baja

<!-- END_96a9f55b1b7a6f5618565174cdc5dc85 -->

#Metodos para el F.U.D.


<!-- START_376ad92579502087eb0ae4e5b69c45b1 -->
## Metodo POST Insertar un nuevo Caso.

en este metodo podemos insertar todo los campos referentes al sujeto procesal<br><br>
 <p><b>CAMPOS DE INSERCION EN EL POST</b></p>

> Example request:

```bash
curl -X POST "http://api-dev.fiscalia.gob.bo/api/v2/casos" \
    -H "Authorization: Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}" \
    -H "Content-Type: application/json" \
    -d '{"codigo_fud":"quibusdam","tipo_denuncia_id":14,"fecha_denuncia":"consequatur","codigo_oficina":1,"codigo_municipio":"est","zona_hecho":"voluptate","direccion_hecho":"sequi","referencia_hecho":"et","longitud":"fuga","latitud":"ut","codigo_institucion":7,"user_id":12,"fecha_hora_inicio":"sapiente","fecha_hora_fin":"voluptatem","aproximado":"vel","quien_hizo":"quod","que_hizo":"iure","aquien_hizo":"et","como_hizo":"ut","relato":"deleniti"}'

```

```javascript
const url = new URL("http://api-dev.fiscalia.gob.bo/api/v2/casos");

let headers = {
    "Authorization": "Bearer {eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjQwZTk1YTdjOTUwOWNiYTIzZGQwMzNhNThhMzhiMGMyOWRiMTMzYWQxZWRiMDEzM2QzMWYwZjI4ZGIzNTI5ODlkZjhjMjUxZGU5Y2RmZjdjIn0.eyJhdWQiOiI0IiwianRpIjoiNDBlOTVhN2M5NTA5Y2JhMjNkZDAzM2E1OGEzOGIwYzI5ZGIxMzNhZDFlZGIwMTMzZDMxZjBmMjhkYjM1Mjk4OWRmOGMyNTFkZTljZGZmN2MiLCJpYXQiOjE1Njc0NTU4MTAsIm5iZiI6MTU2NzQ1NTgxMCwiZXhwIjoxNTk5MDc4MjEwLCJzdWIiOiIxMDc5Iiwic2NvcGVzIjpbXX0.LfnWfIlpnNkBkWRZqtydUu5dxg_ydbWpnLlptTOT-BeJFftDfzJC_lyIN97-Zv7n19ywDgMIbSMTTwrsOBjTjzB34ld-hIXkSMg6nJgDZMPgT7jQ9VGkcjrz02yANlIvzjuV8NXthw9QxDmq6fdZfopEdzcfxQc47scRXARqLs035kvB5r_XGf8sFLJ_eN3RFOnId_PKw-JxdPDV28KghNUBSEhh3n2zXYA37OPhQdGpG3lVqAgMpdJIb30XT26VFqmjsifMED1VtleMeScrupmmqykFvfrnkplDYPl1knOLW38K0_SUEm-wmWU5H7UqFJynplnokpK839vDiUcY3vwHGaLWrBf1GVQuHWAoQo1sufRlaTyaplYP0jk103UF6QwY0gcvydK4feKRRN00KiHruj9E5QhFUYZ6T9WMd7lnPUbKewuT_uT6VlIJJXSskWElICH4duAcFXORrCyX2jB_966DC3sOcvWuGcCECER4hv7pJg1g8ISGEAm77uJ3C9jyH8ZJi8BccJceUtuJqltMc7jzCC-wkKL_wqCdrjkz9Da0oThZ8vCT7yZWRPWL0fvpy21HOc5SAQSwu9VHs51VMoHZzEFD6C6bjXlhrc9NnHlGPL0ouchKJFTiqj2cb9JSGy5_AErJJVcYlWClYiVky_dJs8iLIQ64rbDBT1k}",
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "codigo_fud": "quibusdam",
    "tipo_denuncia_id": 14,
    "fecha_denuncia": "consequatur",
    "codigo_oficina": 1,
    "codigo_municipio": "est",
    "zona_hecho": "voluptate",
    "direccion_hecho": "sequi",
    "referencia_hecho": "et",
    "longitud": "fuga",
    "latitud": "ut",
    "codigo_institucion": 7,
    "user_id": 12,
    "fecha_hora_inicio": "sapiente",
    "fecha_hora_fin": "voluptatem",
    "aproximado": "vel",
    "quien_hizo": "quod",
    "que_hizo": "iure",
    "aquien_hizo": "et",
    "como_hizo": "ut",
    "relato": "deleniti"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "message": "se inserto satisfactoriamente",
    "code": 201
}
```

### HTTP Request
`POST api/v2/casos`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    codigo_fud | string |  required  | Código Único de la Denuncia
    tipo_denuncia_id | integer |  required  | Es un catálogo tipo de denuncia (Ejemplo: Verbal, Escrita, Querella, Acción Directa, De oficio)
    fecha_denuncia | date |  required  | Fecha de la denuncia o fecha de registro del denuncia(Ejemplo 2019-10-24 15:30:15)
    codigo_oficina | integer |  required  | Código de la Oficina donde se registró el Hecho (CATÁLOGO DE OFICINAS POLICÍA O MINISTERIO PÚBLICO)
    codigo_municipio | string |  required  | Código de 6 caracteres que identifica al municipio donde sucedió el hecho
    zona_hecho | string |  required  | Zona donde sucedió el hecho
    direccion_hecho | string |  required  | Dirección donde sucedió el hecho
    referencia_hecho | string |  required  | Referencia donde sucedió el hecho.
    longitud | string |  required  | Longitud donde fue el hecho para la geolocalización.
    latitud | string |  required  | Latitud donde fue el hecho para la geolocalización.
    codigo_institucion | integer |  optional  | Codigo de la institución que nos envía el POST
    user_id | integer |  required  | Usuario con la cual se inter opera
    fecha_hora_inicio | date |  required  | Fecha de la denuncia o fecha de registro del denuncia(Ejemplo 2019-10-24 15:30:15)
    fecha_hora_fin | date |  optional  | opcional No obligatorio si se cuenta con fecha exacta, fecha de la denuncia o fecha de registro del denuncia(Ejemplo 2019-10-24 15:30:15)
    aproximado | string |  optional  | opcional No obligatorio momento aproximado de cuando se realizó el hecho
    quien_hizo | string |  required  | Fecha en la que se envio el Certificado REJAF
    que_hizo | string |  required  | alguna observacion del Certificado REJAF
    aquien_hizo | string |  required  | estado del Certificado REJAF
    como_hizo | string |  required  | DOCUMENTO PDF del REJAF
    relato | string |  optional  | opcional Descripción del hecho al momento de la denuncia

<!-- END_376ad92579502087eb0ae4e5b69c45b1 -->