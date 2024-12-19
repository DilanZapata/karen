<?php
namespace Johan\Pruebas\Test;

use Johan\Pruebas\VehiculoController;


/* require_once __DIR__ . '/../src/vehiculoController.php'; */

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class vehiculoTest extends TestCase {
    private $dbMock;

    protected function setUp(): void {
        $this->dbMock = $this->createMock(\PDO::class);
    }

    /* Funcion Caso Prueba Unitaria Intento de registro con datos vacios y faltantes */
    public function testRegistrarVehiculoControlerDatosVaciosFaltantes() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'placa_vehiculo_visitante' => 'MPO01D',
            'tipo_vehiculo_visitante' => 'MT',
            'num_documento_visitante' => '',
        ];

        $resultado = $claseVehiculo->registrarVehiculoControler($datosVehiculo);

        $this->assertEquals(
            '{"titulo":"Error","mensaje":"Lo sentimos, los datos necesarios para registrar el vehiculo son insuficientes."}',
            $resultado
        );
    }
    
    /* Funcion Caso Prueba Unitaria Intento de registro con datos vacios y faltantes */
    public function testRegistrarVehiculoControlerDatosFormatoInvalido() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'placa_vehiculo_visitante' => 'MpO01D',
            'tipo_vehiculo_visitante' => 'MT',
            'num_documento_visitante' => 'CC11120384',
        ];

        $resultado = $claseVehiculo->registrarVehiculoControler($datosVehiculo);

        $this->assertEquals(
            '{"titulo":"Campos incompletos","mensaje":"Lo sentimos, los campos no cumplen con el formato solicitado."}',
            $resultado
        );
    }
    
    
    /* Funcion Caso Prueba Unitaria Intento de registro con datos vacios y faltantes */
    public function testRegistrarVehiculoControlerDatosVehiculoRegistrado() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'placa_vahiculo_anterior' => 'MPO01D',
            'tipo_vehiculo_visitante' => 'MT',
            'num_documento_visitante' => '1112038489',
        ];

        $resultado = $claseVehiculo->registrarVehiculoControler($datosVehiculo);

        $this->assertEquals(
            '{"titulo":"Error","mensaje":"Lo sentimos, los datos necesarios para registrar el vehiculo son insuficientes."}',
            $resultado
        );
    }


    /* Funcion Caso Prueba Unitaria Intento de edicion de vehiculo con datos incompleto o vacios */
    public function testEditarVehiculoControlerDatosVehiculoEditar() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'placa_vahiculo_anterior' => 'MPO01D',
            'placa_vahiculo_edit' => '',
            'tipo_vehiculo_edit' => '',
            'placa_vahiculo_anterior' => '',
            'num_identidad' => '',
            'placa_vahiculo_edit' => '',
            'tipo_vehiculo_edit' => '1112038489',
        ];

        $resultado = $claseVehiculo->editarVehiculoControler($datosVehiculo);

        $this->assertEquals(
            '{"titulo":"Error","mensaje":"Lo sentimos, los datos necesarios para editar el vehiculo son insuficientes."}',
            $resultado
        );
    }
}
