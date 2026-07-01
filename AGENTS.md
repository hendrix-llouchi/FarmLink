# AGENTS.md — AI Core Instructions for FarmLink

## 1. System Context
You are building "FarmLink", a monolithic Laravel + Inertia.js + Vue.js web application for a localized farmer-to-buyer marketplace in the Western Region of Ghana (Takoradi/Tarkwa). 

## 2. Strict Operational Rules
- **No Over-Engineering:** Do not install any extra packages unless explicitly told to. Do not use WebSockets, real-time live map components, or live payment gateways.
- **Incremental Progress:** Build exactly what is requested in the prompt. Do not write ahead or add features out of scope.
- **UI Consistency:** Follow the project Design Brief for every Vue component: mobile-first layouts, green (`#2E7D32`) accents, warm off-white (`#F7F8F5`) backgrounds, and Tabler/Lucide outline icons.
- **No Fragmentation:** Keep all frontend and backend code tightly integrated within this monorepo using Laravel Inertia prop injection. Do not write separate API boilerplate routes unless requested.
- **No Automatic Pushing:** Never push code to remote repositories unless the user has explicitly requested it. Always wait for the user to instruct to push before executing any push commands.

