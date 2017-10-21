package org.inventario.data;

import java.util.ArrayList;
import java.util.List;
import javax.persistence.TypedQuery;

import org.inventario.data.entities.AsignacionItem;
import org.inventario.data.entities.Item;

public class ItemsRepository
  extends BaseRepository<Item>
{
  public ItemsRepository()
  {
    super(Item.class);
  }
  
  public List<Item> get(Long departamentoId)
  {
    List<Item> items = new ArrayList<>(0);
    TypedQuery<Item> qry = this.eMgr.createQuery("SELECT i FROM Item i INNER JOIN AsignacionItem a ON i.id=a.item.id WHERE a.departamento.id=:id", Item.class);
    qry.setParameter("id", departamentoId);
    items = qry.getResultList();
    return items;
  }
  
  public List<Item> get(Long departamentoId, String nombreItem)
  {
    List<Item> items = new ArrayList<>(0);
    TypedQuery<Item> qry = null;
    if ((nombreItem != null) && (nombreItem.trim().length() > 0))
    {
      qry = this.eMgr.createQuery("SELECT i FROM Item i INNER JOIN AsignacionItem a ON i.id=a.item.id WHERE a.departamento.id=:id AND i.nombre LIKE :nombre", Item.class);
      qry.setParameter("nombre", "%" + nombreItem + "%");
    }
    else
    {
      qry = this.eMgr.createQuery("SELECT i FROM Item i INNER JOIN AsignacionItem a ON i.id=a.item.id WHERE a.departamento.id=:id", Item.class);
    }
    qry.setParameter("id", departamentoId);
    qry.setParameter("nombre", "%" + nombreItem + "%");
    items = qry.getResultList();
    return items;
  }
  
  public List<Item> get(long departamentoId, String nombreItem, int startIndex, int pageSize)
  {
    List<Item> items = new ArrayList<>(0);
    TypedQuery<Item> qry = null;
    if ((nombreItem != null) && (nombreItem.trim().length() > 0))
    {
      qry = this.eMgr.createQuery("SELECT i FROM Item i INNER JOIN AsignacionItem a ON i.id=a.item.id WHERE a.departamento.id=:id AND i.nombre LIKE :nombre AND i.estado='A' ORDER BY i.id", Item.class);
      qry.setParameter("nombre", "%" + nombreItem + "%");
    }
    else
    {
      qry = this.eMgr.createQuery("SELECT i FROM Item i INNER JOIN AsignacionItem a ON i.id=a.item.id WHERE a.departamento.id=:id AND i.estado='A' ORDER BY i.id", Item.class);
    }
    qry.setParameter("id", departamentoId);
    qry.setFirstResult(startIndex);
    qry.setMaxResults(pageSize);
    items = qry.getResultList();
    return items;
  }
  
  public AsignacionItem get(long departamentoId, long itemId ){
	  AsignacionItem item= null;
	  TypedQuery<AsignacionItem> qry=this.eMgr.createQuery("SELECT a from AsignacionItem a WHERE a.departamento.id=:departamentoId AND a.item.id=:itemId", AsignacionItem.class);
	  qry.setParameter("departamentoId", departamentoId);
	  qry.setParameter("itemId", itemId);
	 item= qry.getSingleResult();
	  
	  return item;
  }
  
  public Item getItem(Long itemId){
	  Item item= new Item();
	  TypedQuery<Item> qry= this.eMgr.createQuery("SELECT i from Item i WHERE i.id=:id", Item.class);
	  qry.setParameter("id", itemId);
	  item=qry.getSingleResult();
	  return item;
  }
  
  public long getTotal(long departamentoId, String nombreItem)
  {
    long total = 0L;
    TypedQuery<Long> qry = this.eMgr.createQuery("SELECT COUNT(i.id) FROM Item i INNER JOIN AsignacionItem a ON i.id=a.item.id WHERE a.departamento.id=:id AND i.nombre LIKE :nombre AND i.estado='A' ORDER BY i.id ", Long.class);
    qry.setParameter("id", departamentoId);
    qry.setParameter("nombre", "%" + nombreItem + "%");
    total = ((Long)qry.getSingleResult()).longValue();
    return total;
  }
  public void update(AsignacionItem asignacionItem){
	  eMgr.getTransaction().begin();
	  eMgr.merge(asignacionItem);
	  eMgr.getTransaction().commit();
  }

}
