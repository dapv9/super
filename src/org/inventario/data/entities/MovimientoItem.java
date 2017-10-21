package org.inventario.data.entities;

import java.io.Serializable;
import javax.persistence.*;

import org.inventario.data.JsonEnabled;

import com.google.gson.JsonObject;

import lombok.ToString;

import java.util.Date;
import java.util.List;


/**
 * The persistent class for the MovimientoItem database table.
 * 
 */
@Entity
@Table (name="`MovimientoItem`")
@NamedQuery(name="MovimientoItem.findAll", query="SELECT m FROM MovimientoItem m")
public class MovimientoItem implements Serializable, JsonEnabled{
	private static final long serialVersionUID = 1L;

	@Id
	private int id;

	private int cantidad;

	private String estado;

	@Temporal(TemporalType.TIMESTAMP)
	private Date fecha;

	private int usuarioID;

	//bi-directional many-to-one association to Departamento
	@ManyToOne
	@JoinColumn(name="DepartamentoID")
	private Departamento departamento;

	//bi-directional many-to-one association to TipoMovimiento
	@ManyToOne
	@JoinColumn(name="TipoMovimientoID")
	private TipoMovimiento tipoMovimiento;

	//bi-directional many-to-one association to Item
	@ManyToOne
	@JoinColumn(name="ItemID")
	private Item item;

	//bi-directional many-to-one association to SolicitudMovimiento
	@OneToMany(mappedBy="movimientoItem")
	private List<SolicitudMovimiento> solicitudMovimientos;

	public MovimientoItem() {
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

	public String getEstado() {
		return this.estado;
	}

	public void setEstado(String estado) {
		this.estado = estado;
	}

	public Date getFecha() {
		return this.fecha;
	}

	public void setFecha(Date fecha) {
		this.fecha = fecha;
	}

	public int getUsuarioID() {
		return this.usuarioID;
	}

	public void setUsuarioID(int usuarioID) {
		this.usuarioID = usuarioID;
	}

	public Departamento getDepartamento() {
		return this.departamento;
	}

	public void setDepartamento(Departamento departamento) {
		this.departamento = departamento;
	}

	public TipoMovimiento getTipoMovimiento() {
		return this.tipoMovimiento;
	}

	public void setTipoMovimiento(TipoMovimiento tipoMovimiento) {
		this.tipoMovimiento = tipoMovimiento;
	}

	public Item getItem() {
		return this.item;
	}

	public void setItem(Item item) {
		this.item = item;
	}

	public List<SolicitudMovimiento> getSolicitudMovimientos() {
		return this.solicitudMovimientos;
	}

	public void setSolicitudMovimientos(List<SolicitudMovimiento> solicitudMovimientos) {
		this.solicitudMovimientos = solicitudMovimientos;
	}

	public SolicitudMovimiento addSolicitudMovimiento(SolicitudMovimiento solicitudMovimiento) {
		getSolicitudMovimientos().add(solicitudMovimiento);
		solicitudMovimiento.setMovimientoItem(this);

		return solicitudMovimiento;
	}

	public SolicitudMovimiento removeSolicitudMovimiento(SolicitudMovimiento solicitudMovimiento) {
		getSolicitudMovimientos().remove(solicitudMovimiento);
		solicitudMovimiento.setMovimientoItem(null);

		return solicitudMovimiento;
	}
	
	public JsonObject toJson() {
		JsonObject obj = new JsonObject();
		obj.addProperty("id", this.getId());
		obj.addProperty("cantidad", this.getCantidad());
		obj.addProperty("estado", this.getEstado());
		obj.addProperty("fecha", this.getFecha().toString());
		
		return obj;
	}

}