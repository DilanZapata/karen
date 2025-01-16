<?php
namespace Karen\Pruebas\Test;

use Karen\Pruebas\VehiculoController;


/* require_once __DIR__ . '/../src/vehiculoController.php'; */

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

class vehiculoTest extends TestCase {
    private $dbMock;

    protected function setUp(): void {
        $this->dbMock = $this->createMock(\PDO::class);
    }

    /* Funcion Caso Prueba Unitaria Intento de registro con datos vacios y faltantes 1 ejemplo prueba */
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
    
    /* Funcion Caso Prueba Unitaria Intento de registro con datos con el Formato Invalido 2*/
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
    
    
    /* Funcion Caso Prueba Unitaria Intento de registro con datos ya existentes en la base de datos para un respuesta de que ya la persona tiene los datos del vehiculo registrados 3*/
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


    /* Funcion Caso Prueba Unitaria Intento de edicion de vehiculo con datos incompleto o vacios  4*/
    public function testEditarVehiculoControlerDatosVehiculoEditar() {

        $claseVehiculo = new VehiculoController($this->dbMock);
        //metodo
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

    
    /* 5 */
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




    /* Envio de datos vacios pruebas unitarias 6 */
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


    /* Envio de datos correctos pruebas unitarias teniendo en cuenta que si este test se ejecuta el una vez eliminara el vehiculo de la vace de datos es dicir que pasa un segundo test el devolvera el siguiente resultado "mensaje":"El Vehiculo no se elimino correctamente en la base de datos por eso es que se espera este resultado 7*/
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

    /* Envio de datos incorrectos pruebas unitarias   8*/
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
    

    /* Simular el listado propietarios de vehiculos existente en la base de datos buscando que se muestren como tabla 9*/
    public function testListarPropietarioVehiculoTabla() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'tipoListado' => 'tabla',
            'placa_vehiculo' => 'MPO01D',
        ];
        
        $resultado = $claseVehiculo->listarPropietariosVehiculosControler($datosVehiculo);

        $this->assertEquals(
            '{"data":"Se encontraron propietarios registrados y se listan como tabla"}',
            $resultado
        );
    }

    
    

    /* Simular el listado de propietarios de vehiculos existente en la base de datos buscando que se muestren como card 10*/
    public function testListarPropietarioVehiculoCard() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'tipoListado' => 'card',
            'placa_vehiculo' => 'MPO01D',
        ];
        
        $resultado = $claseVehiculo->listarPropietariosVehiculosControler($datosVehiculo);

        $this->assertEquals(
            '{"data":"Se encontraron propietarios registrados y se listan como tarjetas"}',
            $resultado
        );
    }

    /* Simular el listado de propietarios de un vehiculo no existente en la base de datos buscando el mensaje no se encontraron registros 11*/
    public function testListarPropietarioVehiculoCard3() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $datosVehiculo = [
            'tipoListado' => 'card',
            'placa_vehiculo' => 'MPO01A',
        ];
        
        $resultado = $claseVehiculo->listarPropietariosVehiculosControler($datosVehiculo);

        $this->assertEquals(
            '{"data":"No se encontraron propietarios registrados"}',
            $resultado
        );
    }

    

    /* Simular el busqueda de un visitante que no existe*/
    public function testEncontrarUnVisitante() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $dataVisitante = [
            'num_identificacion' => '1112038489'
        ];
        
        $resultado = $claseVehiculo->seleccionarVisitante($dataVisitante);

        $this->assertEquals(
            '{"mensaje":"No logramos encontrar el visitante"}',
            $resultado
        );
    }

    /* Simular el busqueda de un visitante que si existe*/
    public function testEncontrarUnVisitante2() {

        $claseVehiculo = new VehiculoController($this->dbMock);

        $dataVisitante = [
            'num_identificacion' => '1112038485'
        ];
        
        $resultado = $claseVehiculo->seleccionarVisitante($dataVisitante);

        $this->assertEquals(
            '{"mensaje":"logramos encontrar el visitante"}',
            $resultado
        );
    }
}
