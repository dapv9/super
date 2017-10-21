package org.inventario.data;

import org.inventario.data.entities.Departamento;

public class DepartamentoRepository extends BaseRepository<Departamento>{
	public static final long BODEGA=0;
	public DepartamentoRepository(){
		super(Departamento.class);
	}

}
