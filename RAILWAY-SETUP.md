# Railway Deployment Guide - wp-content Only Repository

This guide shows how to deploy a **wp-content only** repository to Railway, which will create a complete WordPress installation.

## 🏗️ Repository Structure

Since you're only tracking wp-content, your repo looks like:

```
├── .github/workflows/deploy.yml    # CI/CD pipeline
├── wp-content/                     # Your WordPress themes and plugins
│   ├── themes/
│   │   ├── sage/                   # Your Sage theme
│   │   ├── frost/
│   │   └── twentytwentyfive/
│   └── plugins/                    # Your plugins
├── Dockerfile                      # Builds WordPress + your wp-content
├── railway.toml                    # Railway configuration
├── wp-config-railway.php           # WordPress configuration
└── README.md
```

Railway will:
1. ✅ Start with official WordPress Docker image
2. ✅ Copy your `wp-content` over the default one
3. ✅ Add your configuration files
4. ✅ Provide complete WordPress installation

## 🚀 Step-by-Step Railway Setup

### **Step 1: Create Railway Account**

1. Go to [railway.app](https://railway.app)
2. Click "Login" → "Login with GitHub"
3. Authorize Railway to access your repositories

### **Step 2: Create New Project**

1. Click "New Project" in Railway dashboard
2. Select "Deploy from GitHub repo"
3. Choose your wp-content repository
4. Railway will detect the Dockerfile automatically

### **Step 3: Add MySQL Database**

1. In your Railway project, click "New Service"
2. Select "Database" → "Add MySQL"
3. Railway creates MySQL service and connects it
4. **Environment variable `DATABASE_URL` is automatically created**

### **Step 4: Configure Environment Variables (Optional)**

Railway automatically provides:
- `DATABASE_URL` - MySQL connection string
- `RAILWAY_PUBLIC_DOMAIN` - Your app URL
- `PORT` - Application port

You can add custom variables if needed:
1. Go to your service → "Variables" tab
2. Add any custom environment variables

### **Step 5: Deploy!**

Railway will automatically:
1. ✅ Build your Sage theme (if configured)
2. ✅ Create Docker container with WordPress + your wp-content
3. ✅ Deploy to Railway infrastructure
4. ✅ Provide public URL

**First deployment takes ~2-3 minutes**

### **Step 6: Access Your Site**

1. Click "View Logs" to monitor deployment
2. Once deployed, click the generated URL (e.g., `yourapp.railway.app`)
3. Complete WordPress installation wizard
4. Your custom themes will be available!

## ⚙️ GitHub Actions Integration (Optional)

### **Required Secrets**

Add to your GitHub repository (`Settings` → `Secrets and variables` → `Actions`):

- `RAILWAY_TOKEN` - Get from Railway dashboard → Account → Tokens
- `RAILWAY_SERVICE_ID` - Get from Railway service URL (optional)

### **How it Works**

When you push to `main`:
1. ✅ GitHub Actions builds your themes
2. ✅ Cleans development files
3. ✅ Deploys to Railway
4. ✅ Railway rebuilds and redeploys

## 🛠️ Manual Deployment with Railway CLI

### **Install CLI**
```bash
npm install -g @railway/cli
```

### **Login and Link**
```bash
# Login to Railway
railway login

# Link to your project (run in your repo directory)
railway link

# Deploy manually
railway up
```

### **Useful CLI Commands**
```bash
# View logs
railway logs

# Check status
railway status

# Open app in browser
railway open

# Run commands in Railway environment
railway run php wp-cli.phar --info
```

## 🔧 Configuration Details

### **wp-config-railway.php**
- Reads `DATABASE_URL` from Railway MySQL service
- Sets up WordPress constants automatically
- Handles Railway-specific URL configuration
- Production-optimized settings

### **Dockerfile**
- Starts with `wordpress:6.4-php8.2-apache`
- Copies your `wp-content` over default
- Installs your wp-config
- Sets proper file permissions
- Adds security headers

### **railway.toml**
```toml
[build]
buildCommand = "./build-themes.sh"

[deploy]
healthcheckPath = "/wp-admin/admin-ajax.php"
healthcheckTimeout = 300
```

### **build-themes.sh**
- Automatically detects all themes with `package.json`
- Builds each theme with npm/composer
- Cleans up development files
- Works with any number of themes

## 📊 Railway Dashboard Features

### **Metrics Tab**
- CPU, Memory, Network usage
- Request/response metrics
- Error rates

### **Variables Tab**
- Environment variables
- Railway automatically sets DATABASE_URL
- Add custom variables here

### **Settings Tab**
- Custom domains (paid plans)
- Service configuration
- Danger zone (delete service)

### **Deployments Tab**
- Deployment history
- Rollback to previous versions
- Build logs and status

## 🌐 Custom Domain Setup

### **Free Subdomain**
Railway provides: `yourapp.railway.app`
- ✅ Automatic HTTPS
- ✅ Global CDN
- ✅ No configuration needed

### **Custom Domain** (Paid Plans)
1. Go to Settings → Domains
2. Add your domain (e.g., `mydemo.com`)
3. Update DNS: Create CNAME pointing to Railway
4. SSL certificate auto-generated

## 💰 Railway Pricing

### **Free Tier (Perfect for Demos)**
- $0/month
- 512MB RAM
- 1 vCPU
- $5/month usage limit (plenty for demos)
- Community support

### **Paid Plans** (If you need more)
- $5/month removes usage limits
- More resources available
- Custom domains included

## 🚨 Troubleshooting

### **Build Failures**
```bash
# Check build logs in Railway dashboard
railway logs

# Common issues:
# - Missing package.json in theme directory
# - Node/PHP version mismatch
# - Build command errors
```

### **Database Connection Issues**
```bash
# Verify DATABASE_URL exists
railway variables

# Check MySQL service status in dashboard
# Ensure wp-config-railway.php is using DATABASE_URL correctly
```

### **Theme Not Loading**
```bash
# Verify theme build completed
# Check wp-content/themes/sage/public/build/ exists
# Ensure file permissions are correct (handled by Dockerfile)
```

### **WordPress Installation Issues**
```bash
# First deployment requires WordPress setup
# Go to yourapp.railway.app/wp-admin/install.php
# Complete installation wizard
# Your themes will be available in Appearance → Themes
```

## 🔄 Deployment Workflow

### **Development → Production**

1. **Local Development**
   - Work on themes in Local by Flywheel
   - Test changes locally

2. **Push Changes**
   ```bash
   git add .
   git commit -m "Update theme"
   git push origin main
   ```

3. **Automatic Deployment**
   - GitHub Actions builds themes
   - Deploys to Railway
   - Site updates automatically

4. **Monitor Deployment**
   - Check Railway dashboard
   - View logs if needed
   - Test live site

## ✅ Benefits of Railway + wp-content Approach

### **Development Benefits**
- ✅ Only track your custom code (themes/plugins)
- ✅ WordPress core stays clean and updatable
- ✅ Smaller git repository
- ✅ Focus on your custom development

### **Deployment Benefits**
- ✅ $0/month hosting cost
- ✅ Automatic WordPress installation
- ✅ Managed MySQL database
- ✅ Zero server maintenance
- ✅ Automatic HTTPS and CDN

### **Production Benefits**
- ✅ Always latest WordPress core
- ✅ Your customizations preserved
- ✅ Easy rollbacks via Railway
- ✅ Built-in monitoring and logs

This approach gives you the best of both worlds - clean development environment and production-ready deployment! 🎉