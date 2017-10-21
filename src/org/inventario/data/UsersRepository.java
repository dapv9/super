package org.inventario.data;

import javax.persistence.NoResultException;
import javax.persistence.NonUniqueResultException;
import javax.persistence.TypedQuery;

import org.inventario.data.entities.Usuario;
import org.inventario.util.SecurityHelper;

public class UsersRepository extends BaseRepository<Usuario> {

	public UsersRepository() {
		super(Usuario.class);
	}
	
	public Usuario get(String nombre){
		Usuario user=null;
		TypedQuery<Usuario> qry=eMgr.createQuery("SELECT u FROM Usuario u WHERE u.nombre = :nombre ", Usuario.class);
		qry.setParameter("nombre", nombre);
		try {
			user=qry.getSingleResult();
			//| <--para capturar 2 excepciones en un solo catch
		} catch (NoResultException | NonUniqueResultException nre ) {
			logger.error("No se obtuvieron resultados o el resultado no es unico ", nre);
		}
		return user;
	}
	
	public Usuario login(String nombre, String password){
		Usuario user=get(nombre);
		if(user !=null && !SecurityHelper.verificar(password, user.getClave())){
			user = null;
		}
		return user;
	}
	
	public void add(Usuario usr, String repetirClave){
		if(usr.getClave().equals(repetirClave)){
			usr.setClave(SecurityHelper.encriptar(usr.getClave()));
			add(usr);
		}
	}
	

}
