package org.inventario.tests;

import static org.junit.Assert.*;

import java.net.URI;
import java.util.List;
import java.util.Properties;

import javax.persistence.EntityManager;
import javax.persistence.Persistence;
import javax.persistence.TypedQuery;

import org.inventario.data.entities.Rol;
import org.junit.Before;
import org.junit.Test;

public class JPATest {
	private EntityManager eMgr;

	@Before
	public void setUp() throws Exception {
		URI dbUri;
		dbUri = new URI(System.getenv("JAWSDB_URL"));
		 String username = dbUri.getUserInfo().split(":")[0];
		    String password = dbUri.getUserInfo().split(":")[1];
		    String dbUrl = "jdbc:mysql://" + dbUri.getHost() + ':' + dbUri.getPort() + dbUri.getPath();
			Properties properties= new Properties();
			properties.setProperty("javax.persistence.jdbc.url", dbUrl);
			properties.setProperty("javax.persistence.jdbc.user", username);
			properties.setProperty("javax.persistence.jdbc.password", password);
			eMgr = Persistence.createEntityManagerFactory("inventario", properties).createEntityManager();

	}

	@Test
	public void test() {
		TypedQuery<Rol> qry = eMgr.createQuery("select r from Rol r", Rol.class);
		List<Rol> listaRoles = qry.getResultList();
		assertNotNull("**Lista de roles no nula**", listaRoles ); 
		assertNotEquals("**Lista debe tener al menos un elemento**", 0, listaRoles.size());
	}

}
