package org.inventario.data.entities;

import java.io.Serializable;
import java.text.DateFormat;
import java.text.SimpleDateFormat;

import javax.persistence.*;

import org.inventario.data.JsonEnabled;

import com.google.gson.JsonObject;

import lombok.ToString;

import java.util.Date;


/**
 * The persistent class for the SolicitudAsignacion database table.
 * 
 */
@Entity
@Table (name="`SolicitudAsignacion`")
@NamedQuery(name="SolicitudAsignacion.findAll", query="SELECT s FROM SolicitudAsignacion s")
public class SolicitudAsignacion implements Serializable, JsonEnabled {
	private static final long serialVersionUID = 1L;
	//Transient hace que la variable a la que se le asigna sea omitida por el persistence. 
	@Transient
	protected DateFormat fmt;
		
	
	@Id
	private int id;

	@Temporal(TemporalType.TIMESTAMP)
	private Date fechaAutorizacion;

	@Temporal(TemporalType.TIMESTAMP)
	private Date fechaSolicitud;

	//bi-directional many-to-one association to AsignacionItem
	@ManyToOne
	@JoinColumn(name="AsignacionItemID")
	private AsignacionItem asignacionItem;

	//bi-directional many-to-one association to Rol
	@ManyToOne
	@JoinColumn(name="RolAutorizadorID")
	private Rol rol;

	//bi-directional many-to-one association to Usuario
	@ManyToOne
	@JoinColumn(name="UsuarioID")
	private Usuario usuario1;

	//bi-directional many-to-one association to Usuario
	@ManyToOne
	@JoinColumn(name="UsuarioAutorizadorID")
	private Usuario usuario2;
	
	private int cantidad;
	
	private String estado;

	public SolicitudAsignacion() {
		//Se cambio el formato para que la query no me muestre la hora en la parte de la fecha
		this.fmt= new SimpleDateFormat("dd/MM/YYYY");
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public Date getFechaAutorizacion() {
		return this.fechaAutorizacion;
	}

	public void setFechaAutorizacion(Date fechaAutorizacion) {
		this.fechaAutorizacion = fechaAutorizacion;
	}

	public Date getFechaSolicitud() {
		return this.fechaSolicitud;
	}

	public void setFechaSolicitud(Date fechaSolicitud) {
		this.fechaSolicitud = fechaSolicitud;
	}

	public AsignacionItem getAsignacionItem() {
		return this.asignacionItem;
	}

	public void setAsignacionItem(AsignacionItem asignacionItem) {
		this.asignacionItem = asignacionItem;
	}

	public Rol getRol() {
		return this.rol;
	}

	public void setRol(Rol rol) {
		this.rol = rol;
	}

	public Usuario getUsuario1() {
		return this.usuario1;
	}

	public void setUsuario1(Usuario usuario1) {
		this.usuario1 = usuario1;
	}

	public Usuario getUsuario2() {
		return this.usuario2;
	}

	public void setUsuario2(Usuario usuario2) {
		this.usuario2 = usuario2;
	}
	public int getCantidad() {
		return cantidad;
	}

	public void setCantidad(int cantidad) {
		this.cantidad = cantidad;
	}

	public String getEstado() {
		return estado;
	}

	public void setEstado(String estado) {
		this.estado = estado;
	}

	public JsonObject toJson() {
		JsonObject obj = new JsonObject();
		obj.addProperty("id", this.getId());
		obj.addProperty("solicitante", this.getUsuario1().getNombre());
		obj.addProperty("fechaSolicitud", this.fmt.format(fechaSolicitud));
		obj.addProperty("item", this.getAsignacionItem().getItem().getNombre());
		obj.addProperty("itemId", this.getAsignacionItem().getItem().getId());
		obj.addProperty("cantidad", this.getCantidad());
		obj.addProperty("estado", this.getEstado());
		obj.addProperty("autorizador", this.getUsuario2() !=null? this.getUsuario2().getNombre():"");
		obj.addProperty("fechaAutorizacion", this.getFechaAutorizacion() !=null? this.fmt.format(fechaAutorizacion):"");
		
		
		return obj;
	}

}