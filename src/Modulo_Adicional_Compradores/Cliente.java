/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package Modulo_Adicional_Compradores;

/**
 *
 * @author adsi
 */
public class Cliente {
    String nombre;
    String Apellido;
    int Cedula;
    boolean Modo_Pago;
    

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getApellido() {
        return Apellido;
    }

    public void setApellido(String Apellido) {
        this.Apellido = Apellido;
    }

    public int getCedula() {
        return Cedula;
    }

    public void setCedula(int Cedula) {
        this.Cedula = Cedula;
    }

    public boolean isModo_Pago() {
        return Modo_Pago;
    }

    public void setModo_Pago(boolean Modo_Pago) {
        this.Modo_Pago = Modo_Pago;
    }
    
    public void Productos_Comprados(){
        
    }
    
    public void Productos_Devueltos(){
        
    }
}
