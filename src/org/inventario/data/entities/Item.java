package org.inventario.data.entities;

import java.io.Serializable;
import javax.persistence.*;

import org.inventario.data.JsonEnabled;

import com.google.gson.JsonObject;

import lombok.ToString;

import java.util.List;


/**
 * The persistent class for the Item database table.
 * 
 */
@Entity
@Table (name="`Item`")
@NamedQuery(name="Item.findAll", query="SELECT i FROM Item i")
public class Item implements Serializable, JsonEnabled {
	private static final long serialVersionUID = 1L;

	@Id
	private int id;

	private int cantidad;

	private int cantidadMinima;

	private String codigoBarras;

	private String descripcion;

	private String estado;

	@Lob
	private byte[] imagen;

	private String nombre;

	//bi-directional many-to-one association to AsignacionItem
	@OneToMany(mappedBy="item")
	private List<AsignacionItem> asignacionItems;

	//bi-directional many-to-one association to Categoria
	@ManyToOne
	@JoinColumn(name="CategoriaID")
	private Categoria categoria;

	//bi-directional many-to-one association to MovimientoItem
	@OneToMany(mappedBy="item")
	private List<MovimientoItem> movimientoItems;

	public Item() {
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

	public int getCantidadMinima() {
		return this.cantidadMinima;
	}

	public void setCantidadMinima(int cantidadMinima) {
		this.cantidadMinima = cantidadMinima;
	}

	public String getCodigoBarras() {
		return this.codigoBarras;
	}

	public void setCodigoBarras(String codigoBarras) {
		this.codigoBarras = codigoBarras;
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

	public byte[] getImagen() {
		return this.imagen;
	}

	public void setImagen(byte[] imagen) {
		this.imagen = imagen;
	}

	public String getNombre() {
		return this.nombre;
	}

	public void setNombre(String nombre) {
		this.nombre = nombre;
	}

	public List<AsignacionItem> getAsignacionItems() {
		return this.asignacionItems;
	}

	public void setAsignacionItems(List<AsignacionItem> asignacionItems) {
		this.asignacionItems = asignacionItems;
	}

	public AsignacionItem addAsignacionItem(AsignacionItem asignacionItem) {
		getAsignacionItems().add(asignacionItem);
		asignacionItem.setItem(this);

		return asignacionItem;
	}

	public AsignacionItem removeAsignacionItem(AsignacionItem asignacionItem) {
		getAsignacionItems().remove(asignacionItem);
		asignacionItem.setItem(null);

		return asignacionItem;
	}

	public Categoria getCategoria() {
		return this.categoria;
	}

	public void setCategoria(Categoria categoria) {
		this.categoria = categoria;
	}

	public List<MovimientoItem> getMovimientoItems() {
		return this.movimientoItems;
	}

	public void setMovimientoItems(List<MovimientoItem> movimientoItems) {
		this.movimientoItems = movimientoItems;
	}

	public MovimientoItem addMovimientoItem(MovimientoItem movimientoItem) {
		getMovimientoItems().add(movimientoItem);
		movimientoItem.setItem(this);

		return movimientoItem;
	}

	public MovimientoItem removeMovimientoItem(MovimientoItem movimientoItem) {
		getMovimientoItems().remove(movimientoItem);
		movimientoItem.setItem(null);

		return movimientoItem;
	}
	
	public JsonObject toJson() {
		JsonObject obj = new JsonObject();
		obj.addProperty("id", this.getId());
		obj.addProperty("nombre", this.getNombre());
		obj.addProperty("estado", this.getEstado());
		obj.addProperty("categoria", this.getCategoria().getNombre());
		obj.addProperty("cantidad", this.getCantidad());
		obj.addProperty("cantidad minima", this.getCantidadMinima());
		obj.addProperty("codigo de barras", this.getCodigoBarras());
		obj.addProperty("descripcion", this.getDescripcion());
		
		return obj;
	}

}