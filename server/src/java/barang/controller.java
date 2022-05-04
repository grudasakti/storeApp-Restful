/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package barang;

import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.List;
import javax.ws.rs.core.Context;
import javax.ws.rs.core.UriInfo;
import javax.ws.rs.Consumes;
import javax.ws.rs.DELETE;
import javax.ws.rs.Produces;
import javax.ws.rs.GET;
import javax.ws.rs.POST;
import javax.ws.rs.Path;
import javax.ws.rs.PUT;
import javax.ws.rs.core.MediaType;

/**
 * REST Web Service
 *
 * @author Gruda
 */
//memanggil url
@Path("controller")
public class controller {

    @Context
    private UriInfo context;

    /**
     * Creates a new instance of controller
     */
    public controller() {
    }

    @GET
    @Path("/getData")
    @Produces(MediaType.APPLICATION_JSON)
    public ArrayList<model> getData() {
        Statement statement = null;
        try {
            statement = dbConnection.getConnection().createStatement();

            //mengeksekusi query
            //resultset : mengontrol letak kursor terhadap suatu baris didalam database
            ResultSet resultSet = statement.executeQuery("SELECT * FROM data_barang");

            //Membuat Objek ArrayList
            List<model> list = new ArrayList<>();
            while (resultSet.next()) {
                model barang = new model();

                barang.setId(resultSet.getInt("id"));
                barang.setNama(resultSet.getString("nama"));
                barang.setStok(resultSet.getInt("stok"));
                barang.setHarga(resultSet.getInt("harga"));
                list.add(barang);
            }

            return (ArrayList<model>) list;

        } catch (SQLException e) {
            return null;
        } finally {
            if (statement != null) {
                try {
                    statement.close();
                } catch (SQLException e) {
                }
            }
        }
    }

    @GET
    @Path("/getData/{id}")
    @Produces(MediaType.APPLICATION_JSON)
    public model getData(@javax.ws.rs.PathParam("id") int id) {
        Statement statement = null;
        try {
            statement = dbConnection.getConnection().createStatement();

            //mengeksekusi query
            //resultset : mengontrol letak kursor terhadap suatu baris didalam database
            ResultSet resultSet = statement.executeQuery("SELECT * FROM data_barang WHERE id = " + id);

            //Membuat Objek ArrayList
            model barang = new model();
            while (resultSet.next()) {
                barang.setId(resultSet.getInt("id"));
                barang.setNama(resultSet.getString("nama"));
                barang.setStok(resultSet.getInt("stok"));
                barang.setHarga(resultSet.getInt("harga"));
            }

            return barang;

        } catch (SQLException e) {
            return null;
        } finally {
            if (statement != null) {
                try {
                    statement.close();
                } catch (SQLException e) {
                }
            }
        }
    }

    @POST
    @Path("/postData")
    @Produces(MediaType.APPLICATION_JSON)
    public model postData(model barang) {
        Statement statement = null;
        try {
            statement = dbConnection.getConnection().createStatement();

            //mengeksekusi query
            statement.executeUpdate("INSERT INTO data_barang (nama, stok, harga) VALUES ('" + barang.getNama() + "', " + barang.getStok() + ", " + barang.getHarga() + ")");

        } catch (SQLException e) {
            return null;
        } finally {
            if (statement != null) {
                try {
                    statement.close();
                } catch (SQLException e) {
                }
            }
        }
        return null;
    }

    @PUT
    @Path("/updateData")
    @Consumes(MediaType.APPLICATION_JSON)
    public model updateData(model barang) {
        Statement statement = null;
        try {
            statement = dbConnection.getConnection().createStatement();

            //mengeksekusi query
            statement.executeUpdate("UPDATE data_barang SET nama = '" + barang.getNama() + "', stok = " + barang.getStok() + ", harga = " + barang.getHarga() + " WHERE id = " + barang.getId());

        } catch (SQLException e) {

        } finally {
            if (statement != null) {
                try {
                    statement.close();
                } catch (SQLException e) {
                }
            }
        }
        return null;
    }

    @DELETE
    @Path("/deleteData/{id}")
    @Produces(MediaType.APPLICATION_JSON)
    public model deleteData(@javax.ws.rs.PathParam("id") int id) {
        Statement statement = null;

        try {
            statement = dbConnection.getConnection().createStatement();

            //mengeksekusi query
            statement.executeUpdate("DELETE FROM data_barang WHERE id='" + id + "'");

        } catch (SQLException e) {
        } finally {
            if (statement != null) {
                try {
                    statement.close();
                } catch (SQLException e) {
                }
            }
        }
        return null;
    }
}
