/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package barang;

/**
 *
 * @author Gruda
 */
public class model {
    //membuat variabel sesuai dengan field yang ada pada table
    private int id, stok, harga;
    private String nama;
    
    //get : mengakses/mendapatkan nilai yg diambil
    public int getId() {
        return id;
    }
    
    //set : mengeset/mengisi nilai kedalam atribut
    public void setId(int id) {
        this.id = id;
    }

    public int getStok() {
        return stok;
    }

    public void setStok(int stok) {
        this.stok = stok;
    }

    public int getHarga() {
        return harga;
    }

    public void setHarga(int harga) {
        this.harga = harga;
    }

    public String getNama() {
        return nama;
    }

    public void setNama(String nama) {
        this.nama = nama;
    }
}
