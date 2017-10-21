package org.inventario.data.entities;

import java.io.Serializable;
import javax.persistence.*;

import org.inventario.data.JsonEnabled;

import com.google.gson.JsonObject;

import lombok.ToString;

import java.util.List;


/**
 * The persistent class for the AsignacionItem database table.
 * 
 */
@Entity 
@Table (name="`AsignacionItem`")
@NamedQuery(name="AsignacionItem.findAll", query="SELECT a FROM AsignacionItem a")
public class AsignacionItem implements Serializable, JsonEnabled {
	private static final long serialVersionUID = 1L;

	@Id
	private int id;

	private int cantidad;

	//bi-directional many-to-one association to Departamento
	@ManyToOne
	@JoinColumn(name="DepartamentoID")
	private Departamento departamento;

	//bi-directional many-to-one association to Item
	@ManyToOne
	@JoinColumn(name="ItemID")
	private Item item;

	//bi-directional many-to-one association to SolicitudAsignacion
	@OneToMany(mappedBy="asignacionItem")
	private List<SolicitudAsignacion> solicitudAsignacions;

	public AsignacionItem() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getCantidad() {
		return this.cantidad;
	}

	public void setCantidad(int cantidad) {
		this.cantidad = cantidad;
	}

	public Departamento getDepartamento() {
		return this.departamento;
	}

	public void setDepartamento(Departamento departamento) {
		this.departamento = departamento;
	}

	public Item getItem() {
		return this.item;
	}

	public void setItem(Item item) {
		this.item = item;
	}

	public List<SolicitudAsignacion> getSolicitudAsignacions() {
		return this.solicitudAsignacions;
	}

	public void setSolicitudAsignacions(List<SolicitudAsignacion> solicitudAsignacions) {
		this.solicitudAsignacions = solicitudAsignacions;
	}

	public SolicitudAsignacion addSolicitudAsignacion(SolicitudAsignacion solicitudAsignacion) {
		getSolicitudAsignacions().add(solicitudAsignacion);
		solicitudAsignacion.setAsignacionItem(this);

		return solicitudAsignacion;
	}

	public SolicitudAsignacion removeSolicitudAsignacion(SolicitudAsignacion solicitudAsignacion) {
		getSolicitudAsignacions().remove(solicitudAsignacion);
		solicitudAsignacion.setAsignacionItem(null);

		return solicitudAsignacion;
	}
	public JsonObject toJson() {
		JsonObject obj = new JsonObject();
		obj.addProperty("id", this.getId());
		obj.addProperty("cantidad", this.getCantidad());
	
		
		return obj;
	}

}