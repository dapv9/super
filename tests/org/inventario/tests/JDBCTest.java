package org.inventario.tests;
import static org.junit.Assert.*;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;

import org.apache.log4j.Logger;
import org.junit.Before;
import org.junit.Test;


public class JDBCTest {
	private Logger logger;
	
	@Before
	public void setUp(){
		this.logger= Logger.getLogger(this.getClass());
	}

	@Test
	public void test() {
		
		try {
			Class.forName("com.mysql.jdbc.Driver");
		} catch (ClassNotFoundException e) {
			this.logger.error("Error cargando el driver MySQL", e);
		}
	try {
		Connection cn= DriverManager.getConnection("jdbc:mysql://hngomrlb3vfq3jcr.cbetxkdyhwsb.us-east-1.rds.amazonaws.com:3306/fb5pmk6vkxey5bmz", "f0v0578m0m7uf10d", "y2tk33nqbqequ808");
		assertNotNull("Coneccion no debe ser nula", cn);
		assertFalse("Coneccion debe estar abierta", cn.isClosed());
		cn.close();
	} catch (SQLException e) {
		this.logger.error("Error en coneccion ", e);
	}
	
	}

}
