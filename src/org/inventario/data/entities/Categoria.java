package org.inventario.data.entities;

import java.io.Serializable;
import javax.persistence.*;

import org.inventario.data.JsonEnabled;

import com.google.gson.JsonObject;

import lombok.ToString;

import java.util.List;


/**
 * The persistent class for the Categoria database table.
 * 
 */
@Entity
@Table (name="`Categoria`")
@NamedQuery(name="Categoria.findAll", query="SELECT c FROM Categoria c")
public class Categoria implements Serializable, JsonEnabled {
	private static final long serialVersionUID = 1L;

	@Id
	private int id;

	private int categoriaPadreID;

	private String descripcion;

	private String estado;

	private String nombre;

	//bi-directional many-to-one association to Item
	@OneToMany(mappedBy="categoria")
	private List<Item> items;

	public Categoria() {
	}

	public int getId() {
		return this.id;
	}

	public void setId(int id) {
		this.id = id;
	}

	public int getCategoriaPadreID() {
		return this.categoriaPadreID;
	}

	public void setCategoriaPadreID(int categoriaPadreID) {
		this.categoriaPadreID = categoriaPadreID;
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

	public List<Item> getItems() {
		return this.items;
	}

	public void setItems(List<Item> items) {
		this.items = items;
	}

	public Item addItem(Item item) {
		getItems().add(item);
		item.setCategoria(this);

		return item;
	}

	public Item removeItem(Item item) {
		getItems().remove(item);
		item.setCategoria(null);

		return item;
	}
	
	public JsonObject toJson() {
		JsonObject obj = new JsonObject();
		obj.addProperty("id", this.getId());
		obj.addProperty("nombre", this.getNombre());
		obj.addProperty("estado", this.getEstado());
		obj.addProperty("categoriaPadreID", this.getCategoriaPadreID());
		obj.addProperty("descripcion", this.getDescripcion());
		
		return obj;
	}

}