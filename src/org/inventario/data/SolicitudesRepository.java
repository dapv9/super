package org.inventario.data;

import java.util.ArrayList;
import java.util.List;
import javax.persistence.EntityManager;
import javax.persistence.TypedQuery;
import org.inventario.data.entities.SolicitudAsignacion;

public class SolicitudesRepository
  extends BaseRepository<SolicitudAsignacion>
{
  public SolicitudesRepository()
  {
    super(SolicitudAsignacion.class);
  }
  
  public List<SolicitudAsignacion> get(long departamentoId, String nombreItem, int startIndex, int pageSize)
  {
    List<SolicitudAsignacion> solicitudes = new ArrayList(0);
    TypedQuery<SolicitudAsignacion> qry = null;
    if ((nombreItem != null) && (nombreItem.trim().length() > 0))
    {
      qry = this.eMgr.createQuery("SELECT s FROM SolicitudAsignacion s INNER JOIN AsignacionItem a ON s.asignacionItem.id=a.id INNER JOIN Item i ON a.item.id=i.id WHERE a.departamento.id= :departamento AND i.nombre LIKE :nombre ", SolicitudAsignacion.class);
      qry.setParameter("nombre", "%" + nombreItem + "%");
    }
    else
    {
      qry = this.eMgr.createQuery("SELECT s FROM SolicitudAsignacion s INNER JOIN AsignacionItem a ON s.asignacionItem.id=a.id INNER JOIN Item i ON a.item.id=i.id WHERE a.departamento.id= :departamento ", SolicitudAsignacion.class);
    }
    qry.setParameter("departamento", Long.valueOf(departamentoId));
    qry.setFirstResult(startIndex);
    qry.setMaxResults(pageSize);
    solicitudes = qry.getResultList();
    return solicitudes;
  }
  
  public SolicitudAsignacion getSolicitudPendiente(long departamentoId, long itemId){
	  SolicitudAsignacion solicitud= new SolicitudAsignacion();
	  TypedQuery<SolicitudAsignacion> qry=this.eMgr.createQuery("SELECT s FROM SolicitudAsignacion s INNER JOIN AsignacionItem a ON s.asignacionItem.id=a.id  WHERE a.departamento.id= :departamentoId AND a.item.id= :itemId AND  s.estado='P'", SolicitudAsignacion.class);
	  qry.setParameter("departamentoId", departamentoId);
	  qry.setParameter("itemId", itemId);
	  solicitud=qry.getSingleResult();
	  return solicitud;
  }
}
