/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

package Control;

/**
 *
 * @author adsi
 */
public class Entrada_Producto {
   boolean Tipo_Entrada;
   int nrm_producto_e;
   String fch_entrada; 

   
    public boolean isTipo_Entrada() {
        return Tipo_Entrada;
    }

    public void setTipo_Entrada(boolean Tipo_Entrada) {
        this.Tipo_Entrada = Tipo_Entrada;
    }
    
    public int getNrm_producto_e() {
        return nrm_producto_e;
    }

    public void setNrm_producto_e(int nrm_producto_e) {
        this.nrm_producto_e = nrm_producto_e;
    }

    public String getFch_entrada() {
        return fch_entrada;
    }

    public void setFch_entrada(String fch_entrada) {
        this.fch_entrada = fch_entrada;
    }
    public void registrar_entrada(){
        
    }
}
