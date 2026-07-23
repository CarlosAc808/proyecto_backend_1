<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();


        //User::factory()->create([
          //  'name' => 'Test User',
            //'email' => 'test@example.com',
        //]);
         $this->call([
                       RolesSeeder::class,
            EspecialidadesSeeder::class,
            UsuariosSeeder::class,
            ClinicasSeeder::class,
            FarmaciasSeeder::class,
            PlanesSeeder::class,
            TiposPagoDoctorSeeder::class,
            CategoriasMedicamentosSeeder::class,
            DistribuidoresSeeder::class,
            InstrumentosMedicosSeeder::class,
            MedicamentosSeeder::class,
            ConsultoriosSeeder::class,
            HabitacionesSeeder::class,
            DoctoresSeeder::class,
            DoctorConsultoriosSeeder::class,
            HorariosDoctoresSeeder::class,
            PacientesSeeder::class,
            InventarioSeeder::class,
            ConsultorioInstrumentosSeeder::class,
            CitasSeeder::class,
            ConsultasSeeder::class,
            RecetasSeeder::class,
            RecetaDetalleSeeder::class,
            BloqueosHorariosSeeder::class,
            OcupacionHabitacionesSeeder::class,
            SuscripcionesSeeder::class,
            HistorialPagosSeeder::class,
            HistorialSuscripcionesSeeder::class,
            PagosDoctoresSeeder::class,
            PagosDoctoresHistorialSeeder::class,
            NotificacionesSeeder::class,
            UsuarioNotificacionesSeeder::class,
            PreferenciasNotificacionesSeeder::class,
            ExpedienteArchivosSeeder::class,
            IALogsSeeder::class,
            MedicamentosCaducadosSeeder::class,
            MovimientosInventarioSeeder::class,
            UsersSeeder::class,

        ]);
    }
}
