package org.inventario.tests;

import static org.junit.Assert.*;

import org.inventario.data.BaseRepository;
import org.inventario.data.Status;
import org.inventario.data.entities.Rol;
import org.junit.After;
import org.junit.Before;
import org.junit.Test;

public class BaseRepositoryTest {
	private BaseRepository<Rol> repo;

	@Before
	public void setUp() throws Exception {
		repo=new BaseRepository<>(Rol.class);
	}

	@After
	public void tearDown() throws Exception {
		repo.close();
	}

	@Test
	public void testGet() {
		Rol r=repo.get(1);
		assertNotNull("El rol no debe ser nulo", r);
		assertEquals("El rol debe llamarse admin", "admin", r.getNombre());
	}
	
	@Test
	public void testModify(){
		int nuevoId=repo.getMaxId() +1;
		repo.add(new Rol( nuevoId, "test rol", Status.ACTIVO,"test"));
		Rol r1=repo.get(nuevoId);
		assertNotNull("El rol 1 no debe ser nulo", r1);
		assertEquals("El rol debe llamarse test", "test", r1.getNombre());
		
		r1.setNombre("test 2");
		repo.update(r1);
		Rol r2=repo.get(nuevoId);
		assertNotNull("rol 2 no debe ser nulo", r2);
		assertEquals("El rol debe llamarse test 2", "test 2", r2.getNombre());
		
		
		repo.delete(r2);
		
		Rol r3=repo.get(nuevoId);
		assertNull("el rol debe ser nulo", r3);

		
	}

}
