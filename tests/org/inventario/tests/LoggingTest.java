package org.inventario.tests;

import static org.junit.Assert.*;

import java.util.Properties;

import org.apache.log4j.Logger;
import org.apache.log4j.PropertyConfigurator;
import org.inventario.main.Main;
import org.junit.Before;
import org.junit.Test;

public class LoggingTest {
	private Logger log;

	@Before
	public void setUp() throws Exception {
		Properties props = new Properties();
		props.load(Main.class.getResourceAsStream("/META-INF/log4j.properties"));

		PropertyConfigurator.configure(props);
	}

	@Test
	public void test() {
		log = Logger.getLogger(LoggingTest.class);
		assertNotNull("Logger no debe ser nulo", log);
		log.info("log4j funcionando");
	}

}
