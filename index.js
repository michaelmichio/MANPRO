import express from "express";
import mysql from "mysql"
import path from "path";
const app = express();

app.set("view engine","ejs");
const pool = mysql.createPool({
    host:'localhost',
    user : 'root',
    password:'',
    database: 'game of thrones',
    connectionLimit:10
})

const dbConnect = ()=>{
    return new Promise((resolve,reject)=>{
        pool.getConnection((err,conn)=>{
            if(err){
                reject(err);
            }
            else{
                resolve(conn);
            }
        })
    })
}

const cariTopTenKarakter = (conn,masukan)=>{
    return new Promise((resolve,reject)=>{
        conn.query('Select interaksi.target,interaksi.weight FROM interaksi WHERE interaksi.weight>3 AND book=? LIMIT 10',masukan,
        (err,result)=>{
            if(err){
                reject(err);
            }
            else{
                resolve(result);
            }
        })
    })
}

app.get('/',async(req,res)=>{
    res.sendFile('home/index.html',{root:'.'});
})
app.get('/GrafikBar/:buku',async(req,res)=>{
    const conn = await dbConnect();
    const {buku} = req.params;
    const hasil = await cariTopTenKarakter(conn,buku);
    const contoh ="A";
    res.render('GrafikBar',{
        hasil
    })
})


app.listen(8080);