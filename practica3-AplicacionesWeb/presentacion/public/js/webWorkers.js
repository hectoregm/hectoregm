/**
 * @author mangekyou
 */

function dataReceive(e) {
	var respuesta = 'Su nombre es <strong>' + e.data + '</strong>';
	//postMessage(respuesta);
	//testError();

	
	 if (e.data == 'cerrar interno') {
	 postMessage('Worker se detiene internamente');
	 close();
	 } else {
	 var respuesta = 'Su nombre es <strong>' + e.data + '</strong>';
	 postMessage(respuesta);
	 }
	 

}

addEventListener('message', dataReceive, false);
