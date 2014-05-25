# encoding: UTF-8
# This file is auto-generated from the current state of the database. Instead
# of editing this file, please use the migrations feature of Active Record to
# incrementally modify your database, and then regenerate this schema definition.
#
# Note that this schema.rb definition is the authoritative source for your
# database schema. If you need to create the application database on another
# system, you should be using db:schema:load, not running all the migrations
# from scratch. The latter is a flawed and unsustainable approach (the more migrations
# you'll amass, the slower it'll run and the greater likelihood for issues).
#
# It's strongly recommended that you check this file into your version control system.

ActiveRecord::Schema.define(version: 20140525135440) do

  create_table "auths", force: true do |t|
    t.string   "username",               default: "", null: false
    t.boolean  "admin"
    t.string   "nombre"
    t.string   "a_paterno"
    t.string   "a_materno"
    t.boolean  "sexo"
    t.date     "f_nacimiento"
    t.string   "email",                  default: "", null: false
    t.string   "encrypted_password",     default: "", null: false
    t.string   "reset_password_token"
    t.datetime "reset_password_sent_at"
    t.datetime "remember_created_at"
    t.datetime "created_at"
    t.datetime "updated_at"
  end

  add_index "auths", ["email"], name: "index_auths_on_email", unique: true, using: :btree
  add_index "auths", ["reset_password_token"], name: "index_auths_on_reset_password_token", unique: true, using: :btree
  add_index "auths", ["username"], name: "index_auths_on_username", unique: true, using: :btree

  create_table "usuarios", force: true do |t|
    t.string  "username",     limit: 25, null: false
    t.string  "pass",         limit: 30, null: false
    t.boolean "admin",                   null: false
    t.string  "email",        limit: 60, null: false
    t.string  "nombre",       limit: 30, null: false
    t.string  "a_paterno",    limit: 25, null: false
    t.string  "a_materno",    limit: 25, null: false
    t.boolean "sexo",                    null: false
    t.date    "f_nacimiento",            null: false
  end

  add_index "usuarios", ["email"], name: "email", unique: true, using: :btree
  add_index "usuarios", ["username"], name: "username", unique: true, using: :btree

end
