package org.inventario.tests;

import static org.junit.Assert.*;

import org.inventario.util.SecurityHelper;
import org.junit.Test;

public class SecurityTest {

	@Test
	public void test() {
		assertTrue(SecurityHelper.verificar("prueba123", "JyO+/FcqssuaslT4FtfYP0qhsY4PNF8Dw+zXw0qYBbCPr2/G16+GXY8r8DRt1P6r"));
	}

}
