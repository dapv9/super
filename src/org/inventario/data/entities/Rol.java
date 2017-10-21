package org.inventario.data.entities;

import java.io.Serializable;
import javax.persistence.*;

import org.inventario.data.JsonEnabled;

import com.google.gson.JsonObject;

import lombok.AllArgsConstructor;
import lombok.NonNull;
import lombok.RequiredArgsConstructor;
import lombok.ToString;

import java.util.List;


/**
 * The persistent class for the Rol database table.
 * 
 */
//Constructor con todos los campos
@RequiredArgsConstructor
@Entity 
@Table (name="`Rol`")
@NamedQuery(name="Rol.findAll", query="SELECT r FROM Rol r")
public class Rol implements Serializable, JsonEnabled {
	private static final long serialVersionUID = 1L;

	@Id
	@NonNull
	private int id;
	@NonNull
	private String descripcion;
	@NonNull
	private String estado;
	@NonNull
	private String nombre;

	//bi-directional many-to-one association to SolicitudAsignacion
	@OneToMany(mappedBy="rol")
	private List<SolicitudAsignacion> solicitudAsignacions;

	//bi-directional many-to-one association to SolicitudMovimiento
	@OneToMany(mappedBy="rol")
	private List<SolicitudMovimiento> solicitudMovimientos;

	//bi-directional many-to-one association to Usuario
	@OneToMany(mappedBy="rol")
	private List<Usuario> usuarios;

	public Rol() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public String getDescripcion() {
		return this.descripcion;
	}

	public void setDescripcion(String descripcion) {
		this.descripcion = descripcion;
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

	public List<SolicitudAsignacion> getSolicitudAsignacions() {
		return this.solicitudAsignacions;
	}

	public void setSolicitudAsignacions(List<SolicitudAsignacion> solicitudAsignacions) {
		this.solicitudAsignacions = solicitudAsignacions;
	}

	public SolicitudAsignacion addSolicitudAsignacion(SolicitudAsignacion solicitudAsignacion) {
		getSolicitudAsignacions().add(solicitudAsignacion);
		solicitudAsignacion.setRol(this);

		return solicitudAsignacion;
	}

	public SolicitudAsignacion removeSolicitudAsignacion(SolicitudAsignacion solicitudAsignacion) {
		getSolicitudAsignacions().remove(solicitudAsignacion);
		solicitudAsignacion.setRol(null);

		return solicitudAsignacion;
	}

	public List<SolicitudMovimiento> getSolicitudMovimientos() {
		return this.solicitudMovimientos;
	}

	public void setSolicitudMovimientos(List<SolicitudMovimiento> solicitudMovimientos) {
		this.solicitudMovimientos = solicitudMovimientos;
	}

	public SolicitudMovimiento addSolicitudMovimiento(SolicitudMovimiento solicitudMovimiento) {
		getSolicitudMovimientos().add(solicitudMovimiento);
		solicitudMovimiento.setRol(this);

		return solicitudMovimiento;
	}

	public SolicitudMovimiento removeSolicitudMovimiento(SolicitudMovimiento solicitudMovimiento) {
		getSolicitudMovimientos().remove(solicitudMovimiento);
		solicitudMovimiento.setRol(null);

		return solicitudMovimiento;
	}

	public List<Usuario> getUsuarios() {
		return this.usuarios;
	}

	public void setUsuarios(List<Usuario> usuarios) {
		this.usuarios = usuarios;
	}

	public Usuario addUsuario(Usuario usuario) {
		getUsuarios().add(usuario);
		usuario.setRol(this);

		return usuario;
	}

	public Usuario removeUsuario(Usuario usuario) {
		getUsuarios().remove(usuario);
		usuario.setRol(null);

		return usuario;
	}
	public JsonObject toJson() {
		JsonObject obj = new JsonObject();
		obj.addProperty("id", this.getId());
		obj.addProperty("nombre", this.getNombre());
		obj.addProperty("estado", this.getEstado());
		obj.addProperty("descripcion", this.getDescripcion());
		
		return obj;
	}

}