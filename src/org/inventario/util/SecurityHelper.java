package org.inventario.util;

import org.jasypt.util.password.StrongPasswordEncryptor;

public class SecurityHelper {
	private static StrongPasswordEncryptor passwordEncryptor = new StrongPasswordEncryptor();
	
	public static synchronized String encriptar(String clave){
		String encryptedPassword = passwordEncryptor.encryptPassword(clave);
		return encryptedPassword;
	}
	
	public static synchronized boolean verificar(String clave, String encryptedPassword ){
		return passwordEncryptor.checkPassword(clave, encryptedPassword);
	}

}
