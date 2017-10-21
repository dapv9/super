package org.inventario.data;

import java.net.URI;
import java.net.URISyntaxException;
import java.util.ArrayList;
import java.util.List;
import java.util.Properties;

import javax.persistence.EntityManager;
import javax.persistence.NoResultException;
import javax.persistence.Persistence;
import javax.persistence.TypedQuery;

import org.apache.log4j.Logger;

//Usando generic 
public class BaseRepository<T> {
	// constante
	public static final String PERSISTENCE_UNIT = "inventario";
	protected EntityManager eMgr;
	protected Class<T> clase;
	protected Logger logger;

	public BaseRepository(Class<T> clase) {
		this.logger= Logger.getLogger(this.getClass());
		this.clase= clase;
		refresh();
	}

	public T get(long id) {
		T t = null;
		
		TypedQuery<T> qry= eMgr.createQuery("SELECT o FROM "+ clase.getSimpleName() + " o WHERE o.id= :id", clase);
		qry.setParameter("id", id);
		try {
			t=qry.getSingleResult();
	
		} catch (NoResultException nre) {
			logger.error("No se encontro el objeto con id= " + id, nre);
		}
		
		return t;
	}
	
	public List<T> getAll(){
		List<T> listaT = new ArrayList<>(0);
		TypedQuery<T> qry= eMgr.createQuery("SELECT o FROM "+ clase.getSimpleName() + " o", clase);
		listaT =qry.getResultList();
		return listaT;
	}

	public void close() {
		if (eMgr != null) {
			if (eMgr.isOpen()) {
				eMgr.close();
			}
			eMgr=null;
		}
	}

	public void refresh() {
		//https://stackoverflow.com/questions/19773258/how-to-modify-properties-after-create-entity-manager-factory-from-persistence-xm
		close();
		URI dbUri;
		try {
			//https://devcenter.heroku.com/articles/connecting-to-relational-databases-on-heroku-with-java
			dbUri = new URI(System.getenv("JAWSDB_URL"));
			 String username = dbUri.getUserInfo().split(":")[0];
			    String password = dbUri.getUserInfo().split(":")[1];
			    String dbUrl = "jdbc:mysql://" + dbUri.getHost() + ':' + dbUri.getPort() + dbUri.getPath();
				Properties properties= new Properties();
				properties.setProperty("javax.persistence.jdbc.url", dbUrl);
				properties.setProperty("javax.persistence.jdbc.user", username);
				properties.setProperty("javax.persistence.jdbc.password", password);
				eMgr = Persistence.createEntityManagerFactory(PERSISTENCE_UNIT, properties).createEntityManager();
		} catch (URISyntaxException e) {
			logger.error("Exception: " + e.getMessage(), e);	
		}
	   

	}
	
	public void add(T t){
		eMgr.getTransaction().begin();
		eMgr.persist(t);
		eMgr.getTransaction().commit();
	}
	
	public void update(T t){
		eMgr.getTransaction().begin();
		//Merge the state of the given entity into the current persistence context.
		eMgr.merge(t);
		eMgr.getTransaction().commit();
	}
	public void delete(T t){
		eMgr.getTransaction().begin();
		eMgr.remove(t);
		eMgr.getTransaction().commit();
	}
	
	public int getMaxId(){
		int maxId=0;
		//TypedQuery valida que el tipo de dato que le paso corresponda con el query que escribi
		//De acuerdo al tipo de de dato que le paso asi debe ser la clase 
		TypedQuery<Integer> qry= eMgr.createQuery("SELECT MAX(o.id) FROM " + clase.getSimpleName() +" o", Integer.class);
		maxId=qry.getSingleResult();
		return maxId;
	}
	 public long getTotal()
	  {
	    long total = 0L;
	    TypedQuery<Long> qry = this.eMgr.createQuery("SELECT COUNT(o.id) FROM " + this.clase.getSimpleName() + " o", Long.class);
	    total = ((Long)qry.getSingleResult()).longValue();
	    return total;
	  }
}
