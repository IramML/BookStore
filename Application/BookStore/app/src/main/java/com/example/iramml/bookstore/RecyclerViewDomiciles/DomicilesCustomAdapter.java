package com.example.iramml.bookstore.RecyclerViewDomiciles;

import android.content.Context;
import android.support.annotation.NonNull;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.iramml.bookstore.Model.Book;
import com.example.iramml.bookstore.Model.Domicile;
import com.example.iramml.bookstore.R;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;

public class DomicilesCustomAdapter extends RecyclerView.Adapter<DomicilesCustomAdapter.ViewHolder>{
    Context context;
    ArrayList<Domicile> items;
    ClickListener listener;
    ViewHolder viewHolder;

    public DomicilesCustomAdapter(Context context, ArrayList<Domicile> items, ClickListener listener ){
        this.context=context;
        this.items=items;
        this.listener=listener;
    }
    @NonNull
    @Override
    public ViewHolder onCreateViewHolder(@NonNull ViewGroup viewGroup, int i) {
        View view= LayoutInflater.from(context).inflate(R.layout.domiciles_template,viewGroup,false);
        viewHolder=new ViewHolder(view, listener);
        return viewHolder;
    }

    @Override
    public void onBindViewHolder(@NonNull ViewHolder viewHolder, int i) {
        viewHolder.tvStreet.setText(items.get(i).getStreet()+" - "+items.get(i).getOutdoorNumber());
        viewHolder.tvAddress.setText(items.get(i).getPostalCode()+" - "+items.get(i).getState()+" - "+items.get(i).getMunicipality()+
                                    " - "+items.get(i).getColony());
    }
    @Override
    public int getItemCount() {
        return items.size();
    }

    class ViewHolder extends RecyclerView.ViewHolder implements View.OnClickListener{
        TextView tvStreet, tvAddress;
        ClickListener listener;
        public ViewHolder(View itemView, ClickListener listener) {
            super(itemView);
            tvStreet=itemView.findViewById(R.id.tvStreet);
            tvAddress=itemView.findViewById(R.id.tvAddress);
            this.listener=listener;
            itemView.setOnClickListener(this);
        }

        @Override
        public void onClick(View view) {
            this.listener.onClick(view, getAdapterPosition());
        }
    }
}