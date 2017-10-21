package org.inventario.tests;

import static org.junit.Assert.*;

import org.inventario.data.entities.Usuario;
import org.junit.Before;
import org.junit.Test;

public class LombokTest {
	String textoUsuario;

	@Before
	public void setUp() throws Exception {
		textoUsuario = "Usuario(id=0, clave=null, estado=null, nombre=null, departamento=null, rol=null)";
	}


	@Test
	public void test() {
		//assertEquals("El texto de Usuario debe es igual", new Usuario().toString(), textoUsuario);
	}

}
