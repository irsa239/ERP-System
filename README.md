🏢 Laravel ERP System  
A complete HR ERP System built with Laravel that helps manage employees, attendance, leaves, salaries, notifications, and internal communication. It’s designed for organizations looking to automate and streamline their internal operations with a user-friendly and scalable system.

🧩 Key Modules  
1. 👨‍💼 Employee Management  
   - Add/Edit/Delete employee records  
   - View all employee details in a list  
   - Individual employee profile view  

2. 📅 Attendance System  
   - Mark attendance for each employee  
   - View daily/monthly attendance  
   - Export attendance to PDF  

3. 📝 Leave Management  
   - Apply for leave  
   - Admin can approve/reject leave  
   - Leave history with filters  

4. 💰 Salary Management  
   - Generate monthly salaries  
   - View payslips (PDF)  
   - Track employee-wise salary history  

5. 📈 Performance Insight Module  
   - Add monthly performance scores  
   - Attach feedback, warning letters  
   - Generate performance PDF reports  
   - Search and filter by month and name  

6. 🔔 Real-Time Notifications  
   - New employee added  
   - Leave approved/rejected  
   - Salary generated alert  

7. 💬 Chat System  
   - Real-time messaging between employees  
   - Typing indicators  
   - Message history (edit/delete supported)  

8. 🔎 Live Search (Google-style)  
   - Instant search suggestions while typing  
   - Search across:  
     - Employees  
     - Attendance  
     - Leaves  
     - Salaries  
     - Reports  

9. 📊 Reports Module  
   - Downloadable reports (PDF support)  
   - Filter by employee, date, or type  

⚙️ Technologies Used  

| Tech         | Description             |  
|--------------|--------------------------|  
| Laravel      | PHP Framework            |  
| PHP 8+       | Backend logic            |  
| MySQL        | Database                 |  
| Tailwind CSS | UI Styling               |  
| Blade        | Templating               |  
| JavaScript   | Frontend interactions    |  
| Git & GitHub | Version Control          |  
| DomPDF       | PDF Generation           |  

📁 Project Structure & Planning  

🧱 Step 1: Folder Structure (Laravel)  
🗄️ Step 2: Database Tables  

| Table Name   | Purpose                           |  
|--------------|-----------------------------------|  
| users        | Login, authentication & roles     |  
| employees    | Employee details                  |  
| attendances  | Daily attendance records          |  
| leaves       | Leave applications & status       |  
| salaries     | Salary details and payslips       |  
| reports      | Generated reports                 |  
| messages     | Chat messages                     |  
| notifications| Real-time alerts                  |  
| performances | Employee performance scores       |  
| feedback     | Monthly feedback with scores      |  
| warnings     | Warning letters issued            |  

🖼️ Step 3: UI Pages Created  
- Login Page  
- Register Page  
- Home Page  
- Dashboard  
- Employee Form (Add/Edit)  
- Employee Profile View  
- Attendance Form  
- Attendance PDF Export  
- Leave Application Page  
- Salary Generation Page  
- Payslip PDF View  
- Reports Page  
- Performance Score Page  
- Feedback & Warning Pages  
- Settings Page  
- Help Page  
- Chat Page  
- Chat Dashboard  
- Live Search Result Pages (Employee, Attendance, Leave, Salary, Reports, Performance)  

⚙️ Step 4: Backend Functionalities  
✅ CRUD operations for Employees  
✅ Attendance: Marking, Viewing, PDF Export  
✅ Leaves: Apply, Approve, Reject  
✅ Salaries: Auto-calculate and PDF Payslip  
✅ Real-time Notifications for events  
✅ Role-based Login System (Admin & User)  
✅ Reports Generation & Filtering  
✅ Google-style Live Search (across modules)  
✅ Real-time Chat with typing indicator  
✅ Performance Insight Module (Add scores, feedback, warnings, reports)  

✅ Step 5: Testing & Final Touches  
🚫 Form Validations (required fields, email, dates)  
✅ Flash Messages for success/errors  
📱 Mobile-friendly, responsive layout  
🎨 Clean, minimal, and user-friendly UI  
🛡️ Security checks (authentication middleware, CSRF)  

🚀 How to Run This Project  
Clone the repository  
```bash
git clone https://github.com/irsa239/ERP-System.git
