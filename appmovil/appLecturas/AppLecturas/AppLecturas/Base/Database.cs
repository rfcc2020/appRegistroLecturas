using AppLecturas.Modelo;
using SQLite;
using System;
using System.Collections.Generic;
using System.Security.Cryptography;
using System.Text;
using System.Threading.Tasks;
namespace AppLecturas.Base
{
    public class Database
    {
        readonly SQLiteAsyncConnection _database;

        public Database(string dbPath)
        {
            _database = new SQLiteAsyncConnection(dbPath);
            _database.CreateTableAsync<ClsUsuario>();
            _database.CreateTableAsync<ClsPersona>();
            _database.CreateTableAsync<ClsMedidor>();
            _database.CreateTableAsync<ClsLectura>().Wait();
        }

        public Task<int> SavePersonaAsync(ClsPersona person)
        {
            return _database.InsertAsync(person);
        }
        public Task<int> SaveUsuarioAsync(ClsUsuario user)
        {
            return _database.InsertAsync(user);
        }
        public Task<int> SaveMedidorAsync(ClsMedidor medidor)
        {
            return _database.InsertAsync(medidor);
        }
        public Task<List<ClsPersona>> GetPersonaAsync()
        {
            return _database.Table<ClsPersona>().ToListAsync();
        }
        public Task<List<ClsPersona>> GetPersonaAsync(int Id)
        {
            return _database.Table<ClsPersona>().Where(c => c.Id == Id).ToListAsync();
        }
        public Task<List<ClsPersona>> GetPersonaAsync(string Ci)
        {
            return _database.Table<ClsPersona>().Where(c => c.Cedula == Ci).ToListAsync();
        }
        public Task<List<ClsMedidor>> GetMedidorAsync()
        {
            try
            {
                return _database.Table<ClsMedidor>().ToListAsync();
            }
            catch(Exception ex) { return null; }
        }
        public Task<List<ClsMedidor>> GetMedidorAsync(int Id)
        {
            return _database.Table<ClsMedidor>().Where(c => c.Id == Id).ToListAsync();
        }
        public Task<List<ClsMedidor>> GetMedidorAsync(string  Sector)
        {
            return _database.Table<ClsMedidor>().Where(c => c.Sector == Sector).ToListAsync();
        }
        public Task<List<ClsMedidor>> GetMedidorPersonaAsync(int IdPersona)
        {
            return _database.Table<ClsMedidor>().Where(c => c.Persona_id == IdPersona).ToListAsync();
        }
        public Task<List<ClsUsuario>> GetUsuarioAsync()
        {
            return _database.Table<ClsUsuario>().ToListAsync();
        }
        public Task<List<ClsUsuario>> GetUsuarioAsync(int Id)
        {
            return _database.Table<ClsUsuario>().Where(c => c.Id == Id).ToListAsync();
        }
        public Task<List<ClsUsuario>> LoginUsuarioAsync(string email)
        {
            return _database.Table<ClsUsuario>().Where(c => c.Email == email).ToListAsync();
        }
        
        public Task<int> SaveLecturaAsync(ClsLectura lectura)
        {
            return _database.InsertAsync(lectura);
        }
        public Task<List<ClsLectura>> GetLecturaAsync()
        {
            return _database.Table<ClsLectura>().ToListAsync();
        }
        public Task<List<ClsLectura>> GetLecturaAsync(int Id)
        {
            return _database.Table<ClsLectura>().Where(c => c.Id == Id).ToListAsync();
        }
        public Task<List<ClsLectura>> GetLecturaMedidorAsync(int IdMedidor)
        {
            return _database.Table<ClsLectura>().Where(c => c.Medidor_id == IdMedidor).ToListAsync();
        }
        public Task<int> UpdateLecturaAsync(ClsLectura lectura)
        {
            return _database.UpdateAsync(lectura);
        }
        public Task<int> DeleteLecturaAsync(ClsLectura lectura)
        {
            return _database.DeleteAsync(lectura);
        }
        public Task<List<ClsLectura>> GetLecturaAsync(string Estado)
        {
            return _database.Table<ClsLectura>().Where(c => c.Estado == Estado).ToListAsync();
        }
        public Task<List<ClsLectura>> GetLecturaAsync(DateTime Fecha, int Medidor_id)
        {
            return _database.Table<ClsLectura>().Where(c => c.Medidor_id==Medidor_id).ToListAsync();
        }
        public Task<int> UpdateLecturaAsync(int Id, int IdServ,string StrEstado)
        {
            var stocksStartingWithA = _database.ExecuteScalarAsync<int>("Update ClsLectura set Estado=?,IdServer=? WHERE Id = ?",StrEstado,IdServ,Id);
            return stocksStartingWithA;
        }
    }
}
