# 📺 Projet de Salon de Visionnage Vidéo

## 📌 Introduction
Ce projet est une plateforme permettant aux utilisateurs de créer ou de rejoindre des salons de visionnage vidéo synchronisés. Chaque salon offre une playlist, un chat en temps réel et une synchronisation des vidéos entre les participants.

---

## 🛠️ Technologies utilisées
- **Frontend** : Nuxt.js, Tailwind CSS  
- **Backend** : Laravel, Socket.io  
- **Base de données** : PostgreSQL  
- **Autres** : WebSockets, JWT Auth, API YouTube  

---

## 🎯 Fonctionnalités principales
### 🎥 Gestion des utilisateurs  
- ✔ Inscription et connexion (JWT)  
- ✔ Création de profil  
- ✔ Gestion des rôles (admin, membre)  

### 🏠 Gestion des salons  
- ✔ Création et suppression de salons  
- ✔ Attribution d'un hôte  
- ✔ Ajout et suppression d'utilisateurs  

### 💬 Chat en temps réel  
- ✔ Envoi de messages instantanés  
- ✔ Historique des discussions  

### 📽️ Gestion des vidéos  
- ✔ Ajout de vidéos à une playlist  
- ✔ Synchronisation en temps réel (lecture/pause)  

---

## 🗂️ Modèle de données  
```json
{
  "User": {
    "id": "string",
    "username": "string",
    "email": "string",
    "password": "string",
    "createdAt": "date"
  },
  "Room": {
    "id": "string",
    "name": "string",
    "host": "User",
    "users": ["User"],
    "playlist": ["Video"],
    "chat": ["Message"]
  },
  "User_Room": {
    "user_id": "User",
    "room_id": "Room",
    "role": "string"
  },
  "Video": {
    "id": "string",
    "title": "string",
    "url": "string",
    "duration": "float",
    "thumbnail": "string"
  },
  "Message": {
    "id": "string",
    "sender": "User",
    "content": "string",
    "timestamp": "date"
  },
  "Playlist": {
    "id": "string",
    "room": "Room",
    "videos": ["Video"]
  }
}


## 📅 Plan de travail (Gantt)

| Tâche                        | Début       | Fin         | Responsable   |
|------------------------------|------------|------------|--------------|
| Étude du besoin              | 26/02/2025 | 01/03/2025 | Équipe       |
| Conception (UML, Wireframe)  | 02/03/2025 | 10/03/2025 | Équipe       |
| Développement backend        | 11/03/2025 | 31/03/2025 | Dev backend  |
| Développement frontend       | 11/03/2025 | 10/04/2025 | Dev frontend |
| Tests et corrections         | 11/04/2025 | 30/04/2025 | QA           |
| Déploiement                  | 01/05/2025 | 10/05/2025 | DevOps       |


## 🚀 Auteurs
👤 NKEOUA Lionel, OUNANA Youssef, Ilyas BENLYAZID
💼 Étudiant en Licence Informatique - Université d'Avignon  
