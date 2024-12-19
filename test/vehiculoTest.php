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
    
    /* Funcion Caso Prueba Unitaria Intento de registro con datos con el Formato Invalido */
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
    
    
    /* Funcion Caso Prueba Unitaria Intento de registro con datos ya existentes en la base de datos para un respuesta de que ya la persona tiene los datos del vehiculo registrados */
    public function testRegistrarVehiculoControlerDatosVehiculoRegistrado() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'placa_vehiculo_visitante' => 'MPO01X',
            'tipo_vehiculo_visitante' => 'MT',
            'num_documento_visitante' => '1112038489',
        ];

        $resultado = $claseVehiculo->registrarVehiculoControler($datosVehiculo);

        $this->assertEquals(
            '{"titulo":"Ya eres propietario","mensaje":"Tal pararece que la persona a la que se ententa asociar el vehiculo con placas ya lo tiene asociado."}',
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
            'tipo_vehiculo_edit' => '1112038412',
        ];

        $resultado = $claseVehiculo->editarVehiculoControler($datosVehiculo);

        $this->assertEquals(
            '{"titulo":"Error","mensaje":"Lo sentimos, los datos necesarios para editar el vehiculo son insuficientes."}',
            $resultado
        );
    }

    
    /* Funcion Caso Prueba Unitaria Intento de edicion de vehiculo con datos con datos ya existentes en la base de datos para un respuesta de que ya el vehiculo no existe Y la persona tampoco */
    public function testEditarVehiculoControlerVehiculoEditar() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'placa_vahiculo_anterior' => 'MPO01D',
            'placa_vahiculo_edit' => 'MPO01F',
            'tipo_vehiculo_edit' => 'DZ',
            'num_identidad' => '1112038489',
        ];
        
        $resultado = $claseVehiculo->editarVehiculoControler($datosVehiculo);

        $this->assertEquals(
            '{"titulo":"Edicion Completa","mensaje":"El Vehiculo se actualizo correctamente en la base de datos."}',
            $resultado
        );
    }




    /* Envio de datos vacios pruebas unitarias */
    public function testEliminarVehiculoControlerVehiculoEliminarVacios() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'placa_vahiculo_anterior' => 'MPO01D',
            'num_identidad' => '',
        ];
        
        $resultado = $claseVehiculo->eliminarVehiculoControler($datosVehiculo);

        $this->assertEquals(
            '{"titulo":"Error","mensaje":"Lo sentimos, los datos necesarios para eliminar el vehiculo son insuficientes."}',
            $resultado
        );
    }


    /* Envio de datos correctos pruebas unitarias */
    public function testEliminarVehiculoControlerVehiculoEliminar() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'placa_vahiculo_anterior' => 'MPO01D',
            'num_identidad' => '112038489',
        ];
        
        $resultado = $claseVehiculo->eliminarVehiculoControler($datosVehiculo);

        $this->assertEquals(
            '{"titulo":"Eliminacion Fallida","mensaje":"El Vehiculo no se elimino correctamente en la base de datos."}',
            $resultado
        );
    }

    /* Envio de datos correctos pruebas unitarias donde se dan datos para que elemine correctamente a un vehiculo*/
    public function testEliminarVehiculoControlerVehiculoFallida() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'placa_vahiculo_anterior' => 'MPO01D',
            'num_identidad' => '112038485',
        ];
        
        $resultado = $claseVehiculo->eliminarVehiculoControler($datosVehiculo);

        $this->assertEquals(
            '{"titulo":"Eliminacion Fallida","mensaje":"El Vehiculo no se elimino correctamente en la base de datos."}',
            $resultado
        );
    }





    
}
