<?php

namespace Database\Seeders;

use App\Models\Usuario;
use App\Models\Rol;
use App\Models\Area;
use App\Models\Localidad;
use App\Models\InfoUsuario;
// Nuevos Modelos Importados
use App\Models\Nivel;
use App\Models\Subnivel;
use App\Models\DisposicionFinal;
use App\Models\Estatu;
use App\Models\LugarRetencion;
use App\Models\PeriodoRetencion;
use App\Models\TipoSolicitud;
use App\Models\Estatus; // <-- Importación del nuevo modelo
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==========================================
        // 1. NUEVOS CATÁLOGOS BASE (MÓDULO DOCUMENTAL)
        // ==========================================

        // Catálogo: Estatus
        $estatusDatos = ['Pendiente', 'Aprobado', 'Rechazado'];
        foreach ($estatusDatos as $est) {
            Estatu::create(['estatus' => $est]); // <-- Utiliza exactamente la columna 'estatu' de tu modelo
        }

        // Estructura de Niveles y Subniveles
        $nivelesDatos = [
            ['nivel' => 1, 'descripcion' => 'Estratégico (Manuales y Políticas)'],
            ['nivel' => 2, 'descripcion' => 'Táctico (Procedimientos Organizacionales)'],
            ['nivel' => 3, 'descripcion' => 'Operativo (Instructivos de Trabajo y Guías)'],
        ];

        foreach ($nivelesDatos as $nd) {
            $nivel = Nivel::create($nd);

            // Creamos subniveles asociados a este nivel
            Subnivel::create([
                'nivel_id' => $nivel->id,
                'descripcion' => 'General - ' . $nivel->descripcion
            ]);
            Subnivel::create([
                'nivel_id' => $nivel->id,
                'descripcion' => 'Específico - ' . $nivel->descripcion
            ]);
        }

        // Catálogo: Disposición Final
        $disposiciones = ['Destrucción física', 'Digitalización y archivo muerto', 'Reciclaje', 'Permanente'];
        foreach ($disposiciones as $disp) {
            DisposicionFinal::create(['disposicion_final' => $disp]);
        }

        // Catálogo: Lugar de Retención
        $lugares = ['Servidor Local (TI)', 'Gabinete de Calidad', 'Archivo Central', 'Nube (SharePoint/Drive)'];
        foreach ($lugares as $lug) {
            LugarRetencion::create(['lugar_retencion' => $lug]);
        }

        // Catálogo: Periodo de Retención
        $periodos = [
            ['tiempo' => 1, 'unidad_tiempo' => 'Año'],
            ['tiempo' => 3, 'unidad_tiempo' => 'Años'],
            ['tiempo' => 5, 'unidad_tiempo' => 'Años'],
            ['tiempo' => 10, 'unidad_tiempo' => 'Años'],
        ];
        foreach ($periodos as $per) {
            PeriodoRetencion::create($per);
        }

        // Catálogo: Tipo de Solicitud (Fijo tal cual lo solicitaste)
        $tiposSolicitud = ['Nuevo', 'Eliminar', 'Actualizar'];
        foreach ($tiposSolicitud as $tipo) {
            TipoSolicitud::create(['tipo_solicitud' => $tipo]);
        }

        // ==========================================
        // 2. CATÁLOGOS PREEXISTENTES Y USUARIOS
        // ==========================================

        // Crear catálogos base independientes (RolFactory creará: admin, calidad, colaborador)
        $roles = Rol::factory()->count(3)->create();
        $localidades = Localidad::factory()->count(3)->create();
        $areas = Area::factory()->count(5)->create();

        // Guardamos los IDs específicos de cada rol para no errar
        $idAdmin = $roles->where('nombre', 'admin')->first()->id ?? $roles[0]->id;
        $idCalidad = $roles->where('nombre', 'calidad')->first()->id ?? $roles[1]->id;
        $idColaborador = $roles->where('nombre', 'colaborador')->first()->id ?? $roles[2]->id;

        // Crear al Director General (Admin) y su información
        $director = Usuario::factory()->create([
            'email' => 'director@empresa.com',
            'rol_id' => $idAdmin,
            'localidad_id' => $localidades->first()->id,
            'area_id' => $areas->first()->id,
            'jefe_inmediato_id' => null,
        ]);

        InfoUsuario::factory()->create([
            'usuario_id' => $director->id,
        ]);

        // Crear Gerentes (Calidad - Reportan directamente al Director)
        $gerentes = Usuario::factory()->count(2)->create([
            'rol_id' => $idCalidad,
            'localidad_id' => fn() => $localidades->random()->id,
            'area_id' => fn() => $areas->random()->id,
            'jefe_inmediato_id' => $director->id,
        ]);

        $gerentes->each(function ($gerente) {
            InfoUsuario::factory()->create([
                'usuario_id' => $gerente->id,
            ]);
        });

        // Crear Empleados del staff (Colaboradores) y su información
        $empleados = Usuario::factory()->count(15)->create([
            'rol_id' => $idColaborador,
            'localidad_id' => fn() => $localidades->random()->id,
            'area_id' => fn() => $areas->random()->id,
            'jefe_inmediato_id' => fn() => $gerentes->random()->id,
        ]);

        $empleados->each(function ($empleado) {
            InfoUsuario::factory()->create([
                'usuario_id' => $empleado->id,
            ]);
        });
    }
}