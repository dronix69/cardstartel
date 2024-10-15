<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="cache-control" content="no-cache">
    <meta http-equiv="Pragma" content="no-cache">
    <meta http-equiv="Expires" content="-1">
    <style type="text/css">
        @page {
            size: 8.5in 14in;
            /* Tamaño de hoja oficio (legal) */
            margin: 0.5in;
            /* Márgenes de media pulgada (ajústalos según necesites) */
        }

        .body {
            padding-top: 10px;
            padding-left: 10px;
            padding-right: 10;
            padding-bottom: 10px;
        }

        .lw {
            font-size: 20px;
            text-align: center;
            margin-top: 20px;
        }

        .la {
            text-align: center;
            font-size: 18px;
            margin-left: 30px;
        }

        .lb {
            text-align: right;
            font-size: 18px;
            margin-right: 50px;
        }

        .lc {
            text-align: justify;
            font-size: 12px;
        }

        .ld {
            font-weight: bold;
            margin-left: 10px;
        }

        table {
            border-collapse: collapse;
            border: 2px solid;
            width: 100%;
        }

        .le {
            list-style-type: upper-latin;
        }

        .lf {
            font-style: normal;
            font-size: 18px;
        }
        
        .logo {
            width: 90px;
            height: auto;
            margin-right: 20px;
            display: flex;
            align-items: flex-start;
            margin-bottom: 10px;
        }

        .bita {
            width: 100%;
            height: auto;
        }
        .edward {
            width: 90%;
            height: 80%;
        }

        section {
            page-break-after: always;
        }
    </style>


    <title>Contrato</title>
</head>

<body class="body">
    <!-- Start your code here -->
    <section>
        <img src="{{ public_path('images/logo.png') }}" alt="Logo de la Escuela" class="logo">

        <p class="lw">Escuela de Conductores CERCA</p>
        <h2 class="la">Contrato</h2>
        <p class="lb">Temuco:
            {{ \Carbon\Carbon::parse($matricula->fecha_matricula)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
        </p>
        <p class="lc">CERCA Ltda, Rut 76.018.710-0, giro de su denominación, representada legalmente por su
            Firmante, ambos
            domililiados para efectos en calle Andrés Bello N° 1180, de Temuco, en adelante LA ESCUELA por una parte y
            por otra Don(ña)
        </p>
        <p class="ld">{{ $matricula->nombre }} {{ $matricula->apellido }}, Run N° {{ $matricula->rut }}, Domiciliado
            en {{ $matricula->direccion }}, Ciudad de {{ $matricula->comuna }} de
            Nacionalidad Chilena, Telefono de contacto: {{ $matricula->telefono }}, email : {{ $matricula->correo }}
        </p>

        <p class="lc">en adelante EL POSTULANTE, se ha convencido el siguiente contrato de Prestación de Servicios:
        </p>

        <p class="lc"><b>PRIMERO: CERCA LTDA.,</b> es una institucion de capacitacion reconocida por el
            Ministerio de Transportes y Telecomunicaciones segun RES Ex 178 de 2005 y 145 de
            2006, para impartir los conociminetos, destrezas y habilidades necesarias para que
            los egresados puedan optar a una Licencia de Conductor Profesional. regida por el
            Decreto 251 de la Subsecretaria de Transporte de 9 de octubre de 1998 y publicada
            en el Diario Oficial el 9 de febrero de 1999
        </p>
        <p class="lc">
            <b>SEGUNDO:</b>El Postulante deja constancia que esta en conocimiento que la ley Nº
            19.495 publicada en el Diario Oficial el 8 de marzo de 1997 y vigente a partir del 8
            de marzo de 2000, que establece en su articulo 13, Nº5 lo siguiente:<b>"Acreditar en
                caso de clase A-3, haber estado en posesión, durante a lo menos dos años, de la
                licencia Clase A-2 o Clase A-1. Tratándose de la Clase A-5, haber estado en posesión
                durante a lo menos dos años, de la Licencia Clase A-4 o Clase A-2"</b>. Como consecuencias
            de lo anterior, no obstante que se impartiera el curso para la Licencia A-3 y/o A-5,
            el Certificado de Casa Moneda le será entregado siempre y cuando haya cumplido con
            la antiguedad antes referida, hecho que se acreditará mediante Hoja de Vida del
            Conductor vigente.
        </p>
        <p class="lc">
            <b>TERCERO: CERCA Ltda.,</b> impartirá el curso para optar a la Licencia Profesional
            Clase @if ($matricula->curso)
                {{ $matricula->curso->curso }}
            @endif, aprobado por el Ministerio de Transporte
            y Telecomunicaciones según las resoluciones correspondientes.
        </p>
        <p class="lc">
            <b>CUARTO:</b> El postulante se compromete a asistir a clases en el siguiente Horario:
            <b><span t-field="o.jornal" /></b> Para dar cumplimiento a lo establecido en el
            D.S 215/98, articulo 12, Nº4, que señala que "La asistencia de los alumnos deberá
            ser como minimo de un 80% a las horas teóricas y 100% a las horas de prácticas".
            Las Prácticas de Conducción se realizarán en horario alterno al de las clases teóricas.
        </p>
        <p class="lc">
            <b>QUINTO:</b>El Programa de Estudios es el siguiente:
        </p>

        <table>
            <tbody>
                <tr>
                    <td>1.</td>
                    <td>Legislación de Transito</td>
                    <td>Gabinete psicotécnico, proyector,video,DVD,TV</td>
                </tr>
                <tr>
                    <td>2.</td>
                    <td>Legislación de Transporte</td>
                    <td>taller de Mecánica, Laboratorio de computación</td>
                </tr>
                <tr>
                    <td>3.</td>
                    <td>Combate de Incendios</td>
                    <td>Software para los diferentes módulos entre otros.</td>
                </tr>
                <tr>
                    <td>4.</td>
                    <td>Prevencion de Riesgo</td>
                    <td>#</td>
                </tr>
                <tr>
                    <td>5.</td>
                    <td>Relaciones Humanas</td>
                    <td>Cuerpo Docente:</td>
                </tr>
                <tr>
                    <td>6.</td>
                    <td>Primeros Auxilios</td>
                    <td>Abogados, Psicólogos, Asistentes Sociales</td>
                </tr>
                <tr>
                    <td>7.</td>
                    <td>Mecánica Básica</td>
                    <td>Expertos en Prevención de Riesgos, Auxiliares</td>
                </tr>
                <tr>
                    <td>8.</td>
                    <td>Infraestructura Rural</td>
                    <td>Paramedicos, Instructores Autorizados</td>
                </tr>
            </tbody>
        </table>

        <p class="lc">
            <b>SEXTO:</b> El valor del curso es la suma de :@if ($matricula->venta)
                {{ $matricula->venta->valor }}
            @endif, que se cancela de la
            siguiente manera, al contado $ @if ($matricula->venta)
                {{ $matricula->venta->total }}
                @endif y en un Nª de cuotas: @if ($matricula->venta)
                    {{ $matricula->venta->cuota }}
                @endif,
                este pago queda asociado al Nª de boleta: @if ($matricula->venta)
                    {{ $matricula->venta->boleta }}
                @endif, lo que deja en saldo el
                monto de : ______________________.
        </p>
        <p class="lc">
            <b>SEPTIMO:</b> El postulante declara estar en conocimiento que el Certificado final de
            aprobación del curso sólo será entregado una vez que el curso esté integramente aprobado
            y cancelado. Los valores correspondientes a los exámenes, psicológicos y psicotécnico
            están incluidos en la suma aqui pactada, sin embargo, en el evento que el postulante
            reprobes dicho exámenes o desistiera de la ejecución del mismo, pagará la suma de $ 25.000
            cantidad que será imputada a cualquiere suma que hubiere pagado anticipado.
        </p>
        <p class="lc">
            <b>OCTAVO:</b> Para todos los efectos, las partes fijan domicilio en la ciudad de Temuco.
        </p>
        <p class="lc">
            <b>NOVENO:</b> El presente contrato se firma en duplicado quedando la primera copia para
            el interesado, la segunada para la carpeta individual del Alumno.
        </p>

        <p class="ld">Nombre del Alumno: {{ $matricula->nombre }} {{ $matricula->apellido }}</p>

        <p class="ld">Firma del Alumno:____________________________________________________</p><br>

        <p class="ld">Escuela de Conductores CERCA</p>
        <p class="ld">RUT : 76.018.710-0</p>
    </section>

    <!-- Hoja de Bitacoras clases practicas -->
    <section>
        <img src="{{ public_path('images/logo.png') }}" alt="Logo de la Escuela" class="logo">
        <p class="lw">Escuela de Conductores</p>
        <p class="la">Dirección Andrés Bello N° 1180, de Temuco, Fono: 217868 Email: cerca@cerca.cl - www.cerca.cl
        </p>

        <p class="ld">BITACORA CLASES PRACTICAS</p>
        <p class="ld">Datos de Practicas:</p>
        <table>
            <tbody>
                <tr>
                    <td>Licencia</td>
                    <td>P.P.U Vehiculo de Instrucción</td>
                    <td>Matricula</td>
                </tr>
                <tr>
                    <td>@if ($matricula->curso)
                      {{ $matricula->curso->curso }}
                  @endif</td>
                    <td>.</td>
                    <td>.</td>
                </tr>
            </tbody>
        </table> <br>
        <p class="ld">Datos del Alumno:</p>
        <p class="ld">Nombre: {{ $matricula->nombre }} {{ $matricula->apellido }}</p>
        <p class="ld">Rut: {{ $matricula->rut }}</p>
        <p class="ld">Fono: {{ $matricula->telefono }}</p>
        <p class="ld">Curso: @if ($matricula->curso)
                {{ $matricula->curso->codigo }}
            @endif
        </p>
        <img src="{{ public_path('images/bitacora.png') }}" alt="Bitacora" class="bita">

    </section>

    <!-- Hojas de epps -->
    <section>
        <img src="{{ public_path('images/logo.png') }}" alt="Logo de la Escuela" class="logo">
        <p class="lw">Escuela de Conductores</p>
        <p class="la">Dirección Andrés Bello N° 1180, de Temuco, Fono: 217868 Email: cerca@cerca.cl - www.cerca.cl
        </p>

        <p class="ld">Nombre: {{ $matricula->nombre }} {{ $matricula->apellido }}</p>
        <p class="ld">Rut: {{ $matricula->rut }} &nbsp;&nbsp;&nbsp;&nbsp; Fecha:  &nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;/</p><br>
        <img src="{{ public_path('images/EPPS.png') }}" alt="EPPS" class="bita">
    </section>

    <!-- Hojas de Edwards -->
    <section>
        <img src="{{ public_path('images/logo.png') }}" alt="Logo de la Escuela" class="logo">
        <p class="lw">EXAMEN PSICOLÓGICO</p>
        

        <p class="ld">Nombre: {{ $matricula->nombre }} {{ $matricula->apellido }} &nbsp;&nbsp;&nbsp;&nbsp; Fecha: {{ \Carbon\Carbon::parse($matricula->fecha_matricula)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</p>
        <p class="ld">Rut: {{ $matricula->rut }} &nbsp;&nbsp;&nbsp;&nbsp; Curso: @if ($matricula->curso)
            {{ $matricula->curso->curso }}@endif</p>
        <img src="{{ public_path('images/edward.png') }}" alt="Edward" class="edward">
    </section>

    <!-- Hojas de Examen psicologico -->
    <section>
        <img src="{{ public_path('images/logo.png') }}" alt="Logo de la Escuela" class="logo">
        <p class="lw">Escuela de Conductores</p>
        <p class="la">Dirección Andrés Bello N° 1180, de Temuco, Fono: 217868 Email: cerca@cerca.cl - www.cerca.cl
        </p>
        <p class="lw">EXAMEN PSICOLÓGICO</p>
        <p class="lb"> {{ \Carbon\Carbon::parse($matricula->fecha_matricula)->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}</p>
        

        <p class="ld">Nombre: {{ $matricula->nombre }} {{ $matricula->apellido }} &nbsp;&nbsp;&nbsp;&nbsp; Rut: {{ $matricula->rut }}</p>
        <p class="ld">Fono: {{ $matricula->telefono }} &nbsp;&nbsp;&nbsp;&nbsp; Curso: @if ($matricula->curso)
            {{ $matricula->curso->curso }}@endif</p><br>
        <img src="{{ public_path('images/examenes.png') }}" alt="Examen" class="bita">
    </section>

</body>

</html>