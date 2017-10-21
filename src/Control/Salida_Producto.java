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
public class Salida_Producto {
    boolean Tipo_Salida;
    int nrm_producto_s;
    String fch_salida;
    
    public boolean isTipo_Salida() {
        return Tipo_Salida;
    }

    public void setTipo_Salida(boolean Tipo_Salida) {
        this.Tipo_Salida = Tipo_Salida;
    }
    
    public int getNrm_producto_s() {
        return nrm_producto_s;
    }

    public void setNrm_producto_s(int nrm_producto_s) {
        this.nrm_producto_s = nrm_producto_s;
    }

    public String getFch_salida() {
        return fch_salida;
    }

    public void setFch_salida(String fch_salida) {
        this.fch_salida = fch_salida;
    }
    public void registrar_salida(){
        
    }
}
