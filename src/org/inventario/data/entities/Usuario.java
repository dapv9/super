package org.inventario.data.entities;

import java.io.Serializable;
import javax.persistence.*;

import org.inventario.data.JsonEnabled;

import com.google.gson.Gson;
import com.google.gson.JsonObject;

import lombok.ToString;

import java.util.List;


/**
 * The persistent class for the Usuario database table.
 * 
 */
@Entity
@Table (name="`Usuario`")
@NamedQuery(name="Usuario.findAll", query="SELECT u FROM Usuario u")
public class Usuario implements Serializable, JsonEnabled {
	private static final long serialVersionUID = 1L;
	

	@Id
	private int id;

	private String clave;

	private String estado;

	private String nombre;

	//bi-directional many-to-one association to Departamento
	@ManyToOne
	@JoinColumn(name="DepartamentoID")
	private Departamento departamento;

	//bi-directional many-to-one association to Rol
	@ManyToOne
	@JoinColumn(name="RolID")
	private Rol rol;

	public Usuario() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getClave() {
		return this.clave;
	}

	public void setClave(String clave) {
		this.clave = clave;
	}

	public String getEstado() {
		return this.estado;
	}

	public void setEstado(String estado) {
		this.estado = estado;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}







	

	

	






	



	public Departamento getDepartamento() {
		return this.departamento;
	}

	public void setDepartamento(Departamento departamento) {
		this.departamento = departamento;
	}

	public Rol getRol() {
		return this.rol;
	}

	public void setRol(Rol rol) {
		this.rol = rol;
	}
	
	public JsonObject toJson() {
		JsonObject obj = new JsonObject();
		obj.addProperty("id", this.getId());
		obj.addProperty("nombre", this.getNombre());
		obj.addProperty("estado", this.getEstado());
	    obj.addProperty("rol", getRol().getNombre());
	    obj.addProperty("departamento", getDepartamento().getNombre());
		
		return obj;
	}

}